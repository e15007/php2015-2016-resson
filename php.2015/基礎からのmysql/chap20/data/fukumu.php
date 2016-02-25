<?php
if(preg_match('/[^0-9]/', '1234')){ // 数字以外が含まれるとtrue
	print '含む';
}else{
	print '含みません';
}
