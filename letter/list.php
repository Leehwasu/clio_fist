<?php include $_SERVER['DOCUMENT_ROOT'].'/common/common.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/common/header.php'; ?>
<style>
@font-face { 
	font-family:'BarcodeFont';
	src:url("/lib/bacode_font/Code39Azalea.woff") format('woff');
}
</style>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include $_SERVER['DOCUMENT_ROOT'].'/common/left_menu.php'; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/common/top_nevi.php'; ?>
        <!-- page content -->
        <div class="right_col" role="main">
        	<div class="row">
        		<div class="col-md-12 col-sm-12">
        			<div class="x_panel">
        				<button id="create_pdf">
                          <i class="fa fa-file-pdf-o"></i> pdf 생성 (html2canvas)
                        </button>
        				<button onclick="html2pdf_click()">
                          <i class="fa fa-file-pdf-o"></i> pdf 생성2 (html2pdf)
                        </button>
        				<button onclick="html2pdf_click()">
                          <i class="fa fa-file-pdf-o"></i> pdf 생성3 (hide)
                        </button>
            			<div id="pdf_wrap" style="width:2480px;position:relative;">
            				<div>
                			<img src="/images/auth_letter.jpg" style="width:2480px">
            				</div>
                			<div style="position:absolute;top:30%;left:50%;transform:translate(-50%,0%);width:60%;font-size:50px">
                			Hellow 수권서
                			Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서Hellow 수권서
                			</div>
                			<div id="barcode" style="position:absolute;top:16.5%;right:6.9%;color:black;transform: rotate(90deg);height:11%">
                			</div>
                			<div style="position:absolute;top:57.5%;left:50%;transform:translate(-50%,0%);width:60%;text-align:center;font-size:50px">
                			테스트테스트해봅시다테스트를<br>
                			테스트테스트해봅시다테<br>
                			天猫国际
                			
                			</div>
            			</div>
        			</div>
    			</div>
			</div>
        </div>
        <!-- /page content -->
        
        <!-- footer content -->
        <?php include $_SERVER['DOCUMENT_ROOT'].'/common/footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/common/footer_js.php'; ?>
    <!-- html2canvas -->
    <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type = "text/javascript" src = "https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    
    <!-- 바코드 -->
    <script type = "text/javascript" src = "/lib/js/jquery-barcode.js"></script>
    
    <!-- <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.min.js"></script> -->
    <!-- html2pdf -->
    <script type = "text/javascript" src = "/lib/html2pdf/html2pdf.bundle.min.js"></script>
    <script>
    	function html2canvas_hide(){
        	$("#pdf_wrap").show();
        	html2canvas($('#pdf_wrap')[0],{scale:1}).then(function(canvas) {
        		var doc = new jsPDF('p', 'px', 'a4'); //jspdf객체 생성
        		//var doc = new jsPDF({ unit: 'px', format: 'a4', orientation: 'p', compressPDF: true }); //jspdf객체 생성
                var imgData = canvas.toDataURL('image/png'); //캔버스를 이미지로 변환
        		var width = doc.internal.pageSize.getWidth();
				var height = doc.internal.pageSize.getHeight();
                doc.addImage(imgData, 'PNG', 0, 0, width, height, 'someAlias', 'FAST'); //이미지를 기반으로 pdf생성
                doc.save('sample-file.pdf'); //pdf저장
            });
        	$("#pdf_wrap").hide();
    	}
        $('#create_pdf').click(function() {
        	//pdf_wrap을 canvas객체로 변환
        	html2canvas($('#pdf_wrap')[0],{scale:1}).then(function(canvas) {
        		var doc = new jsPDF('p', 'px', 'a4'); //jspdf객체 생성
        		//var doc = new jsPDF({ unit: 'px', format: 'a4', orientation: 'p', compressPDF: true }); //jspdf객체 생성
                var imgData = canvas.toDataURL('image/png'); //캔버스를 이미지로 변환
        		var width = doc.internal.pageSize.getWidth();
				var height = doc.internal.pageSize.getHeight();
                doc.addImage(imgData, 'PNG', 0, 0, width, height, 'someAlias', 'FAST'); //이미지를 기반으로 pdf생성
                doc.save('sample-file.pdf'); //pdf저장
            });
            /*
            html2canvas($("#pdf_wrap")[0], {
                    scale: 1,
                    onrendered: function (canvas) {
                        var doc= new jsPDF("p", "mm", "a4");
                        var img= canvas.toDataURL("png");
                        var width= doc.internal.pageSize.getWidth();
                        var height= doc.internal.pageSize.getHeight();
                        doc.addImage(img, 'PNG', 0, 0, '2480', '3508');
                        doc.save('testing.pdf');
                    }
                });*/
        });
        function html2pdf_click(){
        	var element = document.getElementById('pdf_wrap');
			var opt = {
			  margin:       [0,-1,-2,0],
			  filename:     'myfile.pdf',
			  image:        { type: 'jpg', quality: 1 },
			  html2canvas:  { scale: 2, width:'2480', height:'3508'},
			  jsPDF:        { unit: 'mm', format: 'a3', orientation: 'p', compressPDF: true }
			};
			 
			// New Promise-based usage:
			html2pdf().from(element).set(opt).save();
			 
			// Old monolithic-style usage:
			//html2pdf(element, opt);
        }
        function generateBarcode(){
        	var value= "12312-1233";
        	var btype= "code128";
        	var renderer= "css";
        	var settings = {
        		output : renderer,
    			bgColor : "#00ff0000", // 바코드 배경색
    			color : "#000000", // 바코드색
    			barWidth : "3", //바코드 넓이
    			barHeight : "23", //바코드 높이
    			moduleSize : "2",
    			addQuietZone : "1",
    			fontSize : "30"
        	}
        	$("#barcode").barcode(value, btype, settings);
        }
        generateBarcode();
    </script>
  </body>
</html>
