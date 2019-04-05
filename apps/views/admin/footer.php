		<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
			<!-- content ends -->
			</div><!--/#content.span10-->
		<?php } ?>
		</div><!--/fluid-row-->
		<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
		
		<hr>

		<footer>
			<p class="pull-left">&copy; <?php echo anchor(site_url(), 'Copylight', array('target' => '_blank')); ?> <?php echo date('Y') ?></p>
			<p class="pull-right">Powered by: <?php echo anchor(site_url(), 'Hire Vee'); ?></p>
		</footer>
		<?php } ?>

	</div><!--/.fluid-container-->
	
</body>
</html>
