<?PHP
include_once('JSON.php');
include_once('Object.class.php');

class RequestSpamApi extends Object{
	var $api_url='antispam.spamcop.or.kr';
	var $plugin = 'OpenAPI(PHP)';
	
	var $score;
	var $type;
	
	function getSpamScore(){
		return $this->score;
	}
	function getSpamType(){
		return $this->type;
	}
	
	function RequestSpamApi(){
		$this->add('method','getSpamScores');

		$contents = new stdClass;
		$this->add('contents',$contents);
	}

	function addContent($content){
		
		$obj = new stdClass;
		$obj->id = $this->plugin;
		$obj->content = $content;
		$obj->ip = $_SERVER['REMOTE_ADDR'];
		$obj->pubdate = date('Y-m-d H:i:s');
		$obj->domain = $_SERVER["HTTP_HOST"];

		$contents = $this->get('contents');
		$contents->item = array();
		array_push($contents->item,$obj);
		$this->add('contents',$contents);
		
		
		return true;
	}
	
	function _request($body){

		$header = sprintf(
				"POST / HTTP/1.1\r\n".
				"Host: %s\r\n".
				"Connection: close\r\n".
				"Content-Type: text/json; charset=UTF-8\r\n".
				"Content-Length: %s\r\n\r\n".
				"%s\r\n"
				,$this->api_url
				,strlen($body)
				,$body);  

		$fp = @fsockopen($this->api_url, '8405', $errno, $errstr, 5); 
		if(!$fp) return false;

		fputs($fp, $header);

		$data = "";
		while(!feof($fp)) {
			$data .= trim(fgets($fp, 4096));
		}   
		fclose($fp);

		return $data;
	}

	function _getRequestBody(){
		if(!$this->get('method')) return false;
		$obj = $this->getObjectVars();

		$req = new stdClass;
		$req->methodcall = new stdClass;
		$req->methodcall->params = $obj;
		$str = json_encode2($req);
		$str = str_replace(array("\r\n","\n","\t"),array('\n','\n','\t'),$str);

		return $str;
	}

	function _parse($str){
		$obj = json_decode2($str);

		if(!is_object($obj) || !$obj->response) return false;
		
		$response = $obj->response;
		if($response->error != 0) return false;

		
		$this->score = (int)$response->scores->item[0]->score;
		$engType = $response->scores->item[0]->type;
		
		if( $engType === "adult" ){
			$this->type = "����";
		}else if( $engType === "bar" ){
			$this->type = "�������";
		}else if( $engType === "chauffeur" ){
			$this->type = "�븮����";
		}else if( $engType === "fortune" ){
			$this->type = "�";
		}else if( $engType === "gamble" ){
			$this->type = "����";
		}else if( $engType === "game" ){
			$this->type = "����";
		}else if( $engType === "internet" ){
			$this->type = "���ͳ�";
		}else if( $engType === "illegaldrugs" ){
			$this->type = "�ҹ��Ǿ�ǰ";
		}else if( $engType === "loan" ){
			$this->type = "����";
		}else if( $engType === "property" ){
			$this->type = "�ε���";
		}else if( $engType === "etc" ){
			$this->type = "��Ÿ";
		}else if( $engType === "none" ){
			$this->type = "����";
		}
		
		
		return $response;
	}
	
	function request($content){
		$this->addContent($content);
		$body = $this->_getRequestBody();
		$str = $this->_request($body);
		$obj = $this->_parse($str);

		if( $obj == false ){
			return false;
		}
		
		return true;
	}

}
?>
