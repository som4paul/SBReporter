<input type="file" name="<?php echo $name; ?>" class="filestyle" data-buttonname="btn-teal" data-size="sm" <?php if($multiple) { echo 'multiple="multiple"'; } ?> id="<?php echo $id; ?>">
<label class="redtext" id="<?php echo $error_label_id; ?>"></label>


<script type="text/javascript">
	$("body").on("click", "#<?php echo $btn_id; ?>", function () {
		var allowedFiles = [<?php echo $allowed; ?>];
		var fileUpload = $("#<?php echo $id; ?>");
		var lblError = $("#<?php echo $error_label_id; ?>");
		var regex = new RegExp("([a-zA-Z0-9\(\)\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

		var max_size = (<?php echo $max_size; ?>/1024);
		max_size = max_size.toFixed(2);
		var file = document.getElementById("<?php echo $id; ?>").files[0];

		if (typeof(file) === 'undefined') {
			lblError.html("Please select at least one file.");
			return false;
		}

		var size = (file.size/1024/1024);
		size = size.toFixed(2);
		
		if (!regex.test(fileUpload.val().toLowerCase())) {
			lblError.html("Please upload files having extensions: " + allowedFiles.join(', ') + " only.");
			return false;
		}

		if(parseFloat(size) > parseFloat(max_size)) {
			lblError.html("Your file size is: "+size+" MB. Please upload files less than " + max_size + " MB only.");
			return false;
		}
		lblError.html('');
		return true;
	});
</script>