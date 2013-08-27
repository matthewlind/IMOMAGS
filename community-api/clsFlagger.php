<?php 

class postFlagger {
	private $db;
	private $flagthreshold = 3;
	
	function __construct() {
		$this->db = dbConnect();
	}
	
	//just a test function to check connection and db
	function getSPosts($post_id) {

		$sql = "SELECT * FROM superposts WHERE parent = ? ORDER BY id ASC";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array($post_id));

		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		$jposts = json_encode($posts);

		return $this->prettyjson($jposts, true);
	}
	
	//increment flags on a post, either plus or minus 1
	function insertEvent($post_id, $etype, $userid,$eventHash) {

		$rtn = get_defined_vars();
		
		$sql = "SELECT * FROM events WHERE uid = ? AND event_type = ? AND spid = ? AND eventhash = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array($userid, $etype, $post_id,$eventHash));
		if($stmt->rowCount() > 0) {
			$rtn["newcount"] = "dup";
			return $rtn;
		}
		
		$sql = "INSERT INTO events SET uid = ?, event_type = ?, spid = ?, eventhash = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array($userid, $etype, $post_id,$eventHash));
		
		$sql = "SELECT COUNT(id) AS count FROM events WHERE event_type = ? AND spid = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array($etype, $post_id));
		$cnt = $stmt->fetch(PDO::FETCH_ASSOC);
		$rtn["newcount"] = $cnt["count"];
		
		if($etype == "flag" & $rtn["newcount"] > $this->flagthreshold) {
			$sql = "SELECT * FROM superposts WHERE id = ?";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(array($post_id));
			$chk = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if(intval($chk["approved"]) == 2) {
				$rtn["action"] = "SP Teflon!";
			}
			else {
				$sql = "UPDATE superposts SET approved = 0 WHERE id = ?";
				$stmt = $this->db->prepare($sql);
				$stmt->execute(array($post_id));
			
				$rtn["action"] = "SP Censored!";
			}
			
		}
		
		return $rtn;
		
	}
	
	//set flags teflon
	function insulateFlags($post_id) {
		$rtn = get_defined_vars();
		
		$sql = "UPDATE superposts SET approved = 2 WHERE id = ?";

		$stmt = $this->db->prepare($sql);
		$stmt->execute(array($post_id));
		
		$rtn["action"] = "SP Insulated";
		return $rtn;
	}
	
	function resetFlags($post_id) {
		$rtn = get_defined_vars();
		
		$sql = "UPDATE superposts SET approved = 1 WHERE id = ?";

		$stmt = $this->db->prepare($sql);
		$stmt->execute(array($post_id));

		$rtn["action"] = "SP Reset to 1";
		return $rtn;
	}
	
	function maxFlags($post_id) {
		$rtn = get_defined_vars();
		
		$sql = "UPDATE superposts SET approved = 0 WHERE id = ?";

		$stmt = $this->db->prepare($sql);
		$stmt->execute(array($post_id));

		$rtn["action"] = "SP Censored! (Flag to 0)";
		return $rtn;
	}	
	
	
	
	function prettyjson($json, $html = false) {
	    $out = ''; $nl = "\n"; $cnt = 0; $tab = 4; $len = strlen($json); $space = ' ';
	    if($html) {
	        $space = '&nbsp;';
	        $nl = '<br/>';
	    }
	    $k = strlen($space)?strlen($space):1;
	    for ($i=0; $i<=$len; $i++) {
	        $char = substr($json, $i, 1);
	        if($char == '}' || $char == ']') {
	            $cnt --;
	            $out .= $nl . str_pad('', ($tab * $cnt * $k), $space);
	        } else if($char == '{' || $char == '[') {
	            $cnt ++;
	        }
	        $out .= $char;
	        if($char == ',' || $char == '{' || $char == '[') {
	            $out .= $nl . str_pad('', ($tab * $cnt * $k), $space);
	        }
	        if($char == ':') {
	            $out .= ' ';
	        }
	    }
	    return $out;
	}
	
}	
	
	
?>