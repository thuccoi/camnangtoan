<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('Cẩm nang toán', 'Cẩm nang toán học');
$cakeVersion = __d('Phiên bản', '%s','1.0')
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
                <?php echo $scripts_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
                
                echo $this->Html->css(array('cake.generic','bootstrap-theme.min',
                    'bootstrap.min','style'
                    ));
                
		echo $this->Html->script(array('ckeditor/ckeditor',
                    'bootstrap.min','jquery.min','script',
                    array('inline' => false)));
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="container">
		<div class="header">
                    
		</div>
		<div class="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div class="footer">
                    <?php echo $this->element('footer');?>
		</div>
	</div>
</body>
</html>
