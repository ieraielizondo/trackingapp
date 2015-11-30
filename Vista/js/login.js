$(document).ready(function () {
			$('#Registro').hide();
			var oculto=1;
			$('#flecha').addClass("glyphicon glyphicon-arrow-down");
			$('#lbMostrar').click(function(){
				$('#Registro').slideToggle("slow");
				if(oculto==0)
				{
					oculto=1;
					$('#flecha').removeClass("glyphicon-arrow-up")
					.addClass("glyphicon glyphicon-arrow-down");
				}
				else
				{
					oculto=0;
					$('#flecha').removeClass("glyphicon-arrow-down")
					.addClass(" glyphicon-arrow-up")
					.animate();
				}
			});

			$("#verPass").mousedown(function(){
				$("#verPassIcon").removeClass("glyphicon-eye-open")
				.addClass("glyphicon glyphicon-eye-close");
				$("#txtLogPass").attr("type","text");
			});

			$("#verPass").mouseup(function(){
				$("#verPassIcon").removeClass("glyphicon-eye-close")
				.addClass("glyphicon glyphicon-eye-open");
				$("#txtLogPass").attr("type","password").focus();
			});

			$("#verPass2").mousedown(function(){
				$("#verPass2Icon").removeClass("glyphicon-eye-open")
				.addClass("glyphicon glyphicon-eye-close");
				$("#txtRegPass").attr("type","text");
			});

			$("#verPass2").mouseup(function(){
				$("#verPass2Icon").removeClass("glyphicon-eye-close")
				.addClass("glyphicon glyphicon-eye-open");
				$("#txtRegPass").attr("type","password").focus();
			});

			$("#verPass3").mousedown(function(){
				$("#verPass3Icon").removeClass("glyphicon-eye-open")
				.addClass("glyphicon glyphicon-eye-close");
				$("#txtRegPass2").attr("type","text");
			});

			$("#verPass3").mouseup(function(){
				$("#verPass3Icon").removeClass("glyphicon-eye-close")
				.addClass("glyphicon glyphicon-eye-open");
				$("#txtRegPass2").attr("type","password").focus();
			});

		});