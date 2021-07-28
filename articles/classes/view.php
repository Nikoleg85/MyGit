<?php
class View{
	
    public function generate($template_view, $data = array()){
		include 'tamplates/'.$template_view.'.php';
	}
}

?>