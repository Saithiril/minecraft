<?php
include "Controller.php";
include_once "MathComponent.php";

class MathController extends Controller
{
	public function ExpressionAction() {
		if(isset($_GET['expression'])) {
			$expressionString = $_GET['expression'];
			echo MathComponent::resolve($expressionString);
		} else {
			echo "parse error";
		}
	}
}