<?php include $_SERVER['DOCUMENT_ROOT'].'/common/common.php'; ?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/common/header.php'; ?>

<?php
include 'service/service.php';
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
$channel_data=COA_Channl_List();

$channel_code ="";
$channel_Name_Kr ="";
$channel_Name_Ch ="";

for( $i=0; $i<count($channel_data); $i++)
{
  $channel_code .= "|".$channel_data[$i]["Channel_Code"];
  $channel_Name_Kr .= "|".$channel_data[$i]["Name_Kr"];
  $channel_Name_Ch .= "|".$channel_data[$i]["Name_Ch"];
}


$Partner_data=COA_Partner_List();

$Partner_code="";
$Partner_Name_Kr="";
for( $i=0; $i<count($Partner_data); $i++)
{
  $Partner_code .= "|".$Partner_data[$i]["Partner_Code"];
  $Partner_Name_Kr .= "|".$Partner_data[$i]["Partner_Name"];

}
$where ="";
$Start_Date=date("Y-m-d");
$End_Date=date("Y-m-d");

if( isset ($_REQUEST['srt_date']) && isset ($_REQUEST['end_date']))
{
  $Start_Date=$_REQUEST['srt_date'] ;
  $End_Date=$_REQUEST['end_date'] ;
  $Start_Date_1 = str_replace  ('-','' , $Start_Date) ;
  $End_Date_1 = str_replace  ('-','' , $End_Date) ;

 $where = "where Start_Date >= '$Start_Date_1' and 
 End_Date  <= '$End_Date_1' " ;

}
$data=COA_Auth_List( $where);
//$data=COA_Auth_List($where);
//print_r($data);

?>
<style>
@font-face {
	font-family: 'BarcodeFont';
	src: url("/lib/bacode_font/Code39Azalea.woff") format('woff');
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.5/xlsx.full.min.js"></script>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
       
		<?php  include $_SERVER['DOCUMENT_ROOT'].'/common/left_menu.php'; ?>
        <?php  include $_SERVER['DOCUMENT_ROOT'].'/common/top_nevi.php'; ?>
        
		<!-- page content -->
			<div class="right_col" role="main">
      <form action="" method="get">      
      <div class="row">
        <input type="date" id="date" name="srt_date" class="form-control col-2" value=<?= $Start_Date?>>
        <input type="date" id="date" name="end_date"  class="form-control col-2" value=<?= $End_Date?>>
        <button type='submit' class='btn btn-primary mgr10 col-2'  >조회</button>		
    
        
      </div>
      </form>
    <div >
    <div class="row">
   <!-- <button type='button' class='btn btn-primary mgr10 col' onclick='ib.sampleBtn(this)'>엑셀</button> -->
    <input type="file"  onchange="readExcel()" /> 
   
    <div class='col'>      </div>
    <div class='col'>      </div>
    <div class='col'>    
    <div class="row">
    <button type='button' class='btn btn-primary mgr10 col' onclick='ib.sampleBtn(this)'>유효성검사</button>
    			<button type='button' class='btn btn-primary mgr10 col' onclick='ib.sampleBtn(this)'>신규</button>
        
      <button class='btn btn-primary mgr10 col' onclick='ib.sampleBtn(this,1)'>저장</button> 
      </div>
</div>
</div>
    </div>
			<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="x_panel">
							<div style='height:calc(100% - 20px)'><div id='sheetDiv' style='width:100%;height:100%'></div></div>	
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
        <?php  include $_SERVER['DOCUMENT_ROOT'].'/common/footer.php'; ?>
        <!-- /footer content -->
		</div>
	</div>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/common/footer_js.php'; ?>
    <!-- html2canvas -->
    
    
    <!-- ibsheet css -->
	
	<link rel="stylesheet" href="/lib/ibsheet8/css/default/main.css"/>
	<link rel="stylesheet" href="/lib/ibsheet8/css/compatible/light/main.css"/>
	
	<!--  ibsheet 필수 js -->
	<script src="/lib/ibsheet8/ibleaders.js"></script>
	<script src="/lib/ibsheet8/ibsheet.js"></script>
	<script src="/lib/ibsheet8/locale/ko.js"></script>
	
	<!--  ibsheet 선택/추가 js -->
	<script src="/lib/ibsheet8/plugins/ibsheet-common.js"></script>
	<script src="/lib/ibsheet8/plugins/ibsheet-dialog.js"></script>
	<script src="/lib/ibsheet8/plugins/ibsheet-excel.js"></script>
	<script>

    var Excel_data='';
function readExcel() {
  
  const now = new Date();
  const yesterday = "";
 
    let input = event.target;
    let reader = new FileReader();
    reader.onload = function () {
        let data = reader.result;
        let workBook = XLSX.read(data, { type: 'binary' });
        workBook.SheetNames.forEach(function (sheetName) {
            console.log('SheetName: ' + sheetName);
            let rows = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName]);
            Excel_data=JSON.stringify(rows);
            console.log( Excel_data);
            sheet.loadSearchData( rows);

      
/*
            for(i=0;i< Auth_data.length ;i++)
            {
              for(j=0;j< rows.length ;j++)
              {
                if ( Auth_data[i].Template_Num==rows[j].Template_Num &&  )
                {
                  end_date=  Date(Auth_data[0].End_Date  );
                  if(   end_date >  now )
                  {
                    alert("날짜 초과"); 
                  }
                  else if ( Auth_data[i].Template_Num==rows[j].Template_Num )
                  {}
                  //rows[0].Start_Date
                }
              }
            }*/
        })
       
      };
    reader.readAsBinaryString(input.files[0]);   
}
var ib = ib||{};
ib = {
//시트 초기화 구문
'init':{
  //공통기능 설정 부분
  "Cfg": {
    "SearchMode": 0,
    "Alternate": 2,
    "ShowFilter": 1
  },
  "Def": {
    "Row": {
      "Menu": {
        "Items": [
          {
            "Name": "신규 행 추가",
            "Value": "INS",
            "Icon": "../assets/imgs/bullet.gif",
            "IconWidth": 3
          },
          {
            "Name": "행 삭제",
            "Value": "DEL",
            "Icon": "../assets/imgs/bullet.gif",
            "IconWidth": 3
          }
        ],
        "OnSave": menuSave
      }
    }
  },
  //틀고정 좌측 컬럼 설정
 
  //중앙(메인) 컬럼 설정
  "Cols": [ 	
    
    {"Header": "선택","Type": "Bool","Name": "CHK","Width": "50","Align": "Center","CanEdit": 1,"GroupWidth": 200},
    {"Header": "Auth_NO","Name": "Auth_NO","RelWidth": 1,"MinWidth": 80 ,"CanEdit": 0},
    {"Header": "플랫폼","Name": "Template_Num","Type": "Enum","Enum": "|타오바오|타플랫폼","EnumKeys": "|A|B","RelWidth": 1,"MinWidth": 80},
	{"Header": "CLIO","Name": "CLIO","Type": "Bool","RelWidth": 1,"MinWidth": 50},
	{"Header": "Peripera","Name": "Peripera","Type": "Bool","RelWidth": 1,"MinWidth": 50,"CanEdit": 1},
	{"Header": "goodal","Name": "goodal","Type": "Bool","RelWidth": 1,"MinWidth": 50},
	{"Header": "dermatory","Name": "dermatory","Type": "Bool","RelWidth": 1,"MinWidth": 50},
  {"Header": "twinklepop","Name": "twinklepop","Type": "Bool","RelWidth": 1,"MinWidth": 50,},
  {"Header": "A.black","Name": "A_black","Type": "Bool","RelWidth": 1,"MinWidth": 50},
  {"Header": "healingbird","Name": "healingbird","Type": "Bool","RelWidth": 1,"MinWidth": 50},  
  {"Header": "수권채널명","Name": "Channel_Code","Enum": "<?= $channel_Name_Kr ?>","EnumKeys": "<?= $channel_code?>" ,"Type": "Enum","RelWidth": 1,"MinWidth": 80,"Required": 1},
  {"Header": "수권채널링크","Name": "Channel_Link","RelWidth": 1,"MinWidth": 100,"Required": 1},
  {"Header": "수권상점명","Name": "Channel_Stor_Name","RelWidth": 1,"MinWidth": 100,"Required": 1},
  {"Header": "수권상점링크","Name": "Channel_Stor_Link","RelWidth": 1,"MinWidth": 100,"Required": 1},
  {"Header": "수권상점ID","Name": "Channel_Stor_ID","RelWidth": 1,"MinWidth": 100,"Required": 1},
  {"Header": "회사명","Name": "Company_Name","RelWidth": 1,"MinWidth": 100},
  {"Header": "수권기간Form","Name": "Start_Date","Type": "Date","RelWidth": 1,"MinWidth": 100,"Required": 1},
  {"Header": "수권기간TO","Name": "End_Date","Type": "Date","RelWidth": 1,"MinWidth": 100,"Required": 1},
  {"Header": "요청거래처","Name": "Partner_Code","Enum": "<?= $Partner_Name_Kr ?>","EnumKeys": "<?= $Partner_code ?>" ,"Type": "Enum","RelWidth": 1,"MinWidth": 80,"Required": 1},
  {"Header": "오류사유","Name": "Bigo","RelWidth": 1,"MinWidth": 100,"Required": 0},
	//{"Header": "영화명","Name": "sTitle","Bigo": 1,"MinWidth": 200,"Required": 1},
	
  ]
},
//시트 이벤트

//시트객체 생성
'create':function () {
    var options = this.init;

    options.Events = this.event;
    IBSheet.create({

      id: 'sheet', // 생성할 시트의 id
      el: 'sheetDiv', // 시트를 생성할 Dom 객체 및 id
      options: options, // 생성될 시트의 속성
      data: this.data // 생성될 시트의 속성
    });
  },
  'event':{ onKeyDown:function(evtParam){
        // 포커스된 시트에 Insert키 Delete키 입력시 키입력 동작을 막습니다.
        if(evtParam.name == "Del") 
        {
          sheet.deleteRow({row:sheet.getFocusedRow(), del:1});
          sheet.acceptChangedData(sheet.getFocusedRow());
        }
        return true;
    },

    onAfterChange:function (evtParam) {
      // 셀값 수정후 발생합니다.
      // document.getElementById('logs').value = (count()) + '\t 이벤트 명 : ' + evtParam.eventName
      //     + '\t\t\t발생 위치 : ' + (evtParam.row.HasIndex ? evtParam.row.HasIndex + ' 행,' : evtParam.row.id + ' 행,') + (evtParam.col ? evtParam.col + ' 열\n' : '\n') + document.getElementById('logs').value;
      if(sheet.getAttribute(sheet.getFocusedRow(), sheet.getFocusedCol(), "Color")=="#FF0000")
      {
        sheet.setAttribute(sheet.getFocusedRow(), sheet.getFocusedCol(),"Color" ,"#ffffff" );
        val_check(sheet.getFocusedRow());
      }
     
      if(evtParam.col=='Template_Num')
      {
        if(evtParam.val=='A')
        {
      // sheet.setAttribute(sheet.getFocusedRow(), "Channel_Code","CanEdit" ,0);
            var ROW = sheet.getFocusedRow();
            ROW["Channel_Code"] = "CH0000";
            ROW["Channel_Link"] = "www.taobao.com";
            ROW["Company_Name"] = "";
            //변경내용 확인
            sheet.refreshCell({row:ROW, col:"Channel_Code"});
            sheet.setAttribute(sheet.getFocusedRow(), "Channel_Code","CanEdit" ,0);
            sheet.setAttribute(sheet.getFocusedRow(), "Channel_Link","CanEdit" ,0);
            sheet.setAttribute(sheet.getFocusedRow(), "Company_Name","CanEdit" ,0);
          }
          else
          {
            var ROW = sheet.getFocusedRow();
            if(ROW["Channel_Code"] == "CH0000")
            {
              ROW["Channel_Code"] = "CH0001";
              ROW["Channel_Link"] = "";
            }
          
          //변경내용 확인
            sheet.refreshCell({row:ROW, col:"Channel_Code"});
            sheet.setAttribute(sheet.getFocusedRow(), "Channel_Code","CanEdit" ,1);
            sheet.setAttribute(sheet.getFocusedRow(), "Channel_Link","CanEdit" ,1);
            sheet.setAttribute(sheet.getFocusedRow(), "Company_Name","CanEdit" ,1);
          }        
        }
     },
     /*
     onBeforeChange:function (evtParam) {
      // 셀값 수정 전에 발생합니다.
      alert("1");
      document.getElementById('logs').value = (count()) + '\t 이벤트 명 : ' + evtParam.eventName
          + '\t\t\t발생 위치 : ' + (evtParam.row.HasIndex ? evtParam.row.HasIndex + ' 행,' : evtParam.row.id + ' 행,') + (evtParam.col ? evtParam.col + ' 열\n' : '\n') + document.getElementById('logs').value;
    },
    */
    onDataLoad:function (evtParam) {
       
    },
 
  },
//화면 기능
'sampleBtn':function (obj) {
  
 
	switch (obj.textContent) {
      case '유효성검사':
        exel_val();
        break;
      case '신규':
        sheet.addRow({ visible: 1 });
        break;

      case '저장':
          var obj1 = (sheet && sheet.getSaveJson({        
      }));
          $.ajax({
          url: "./COA_Auth_Insert.php",
          type: "post",
          dataType: "json",
          data: {             
            json_ : obj1
          },

          success: function(val) {
            var temp_success_count =0 ;
            var temp_fail_count =0 ;
            for(i=0;i<val.length;i++)
            {
             if(val[i].key==undefined)
             continue;
             if( val[i].Result=="-1")
              {
                var row_ID = sheet.getRowById(val[i].key);
                sheet.setAttribute(row_ID, "Auth_NO","Color" ,"#FF0000" );             
                row_ID["Bigo"] = val[i].Message;                 
                sheet.refreshCell({row:row_ID, col:"Bigo"});
                sheet.acceptChangedData(row_ID);
                temp_fail_count++;
              }
              else
              {
                var row_ID = sheet.getRowById(val[i].key);
                row_ID["Bigo"] = val[i].Message;     
                row_ID["Auth_NO"] = val[i].Auth_NO;          
                                 
                //sheet.refreshCell({row:row_ID, col:"Bigo"});
                sheet.refreshCell({row:row_ID, col:"Auth_NO"});               
                sheet.acceptChangedData(row_ID);
                temp_success_count++;
              }
            } 
             alert("실패 : "+ temp_fail_count +"/ 성공 : " +temp_success_count) ; 
          }
        });
        break;
      case '출력':

        var obj = (sheet && sheet.getSaveJson({
        saveMode: 2
      }));
      var Auth_data="";

      if(obj.data.length==0)
      {
        alert("선택된 파일이 없습니다");
        return;
      }
    for(i = 0 ;i<obj.data.length ;i++)
    {
      if(obj.data[i].CHK=='1')
      {
        Auth_data+=obj.data[i].Auth_NO+'/';
      }
    }
     
      var data='';
         
        var form= document.createElement("form");
        method="post";
        form.setAttribute("method",method);
        form.setAttribute("action","/COA/Print_list.php");
              
          var hiddenField = document.createElement("input");
          hiddenField.setAttribute("type","hidden");
          hiddenField.setAttribute("name","Data");
          hiddenField.setAttribute("value",Auth_data);
          form.appendChild(hiddenField);
          document.body.appendChild(form);
          form.submit();

        return;
      // no default
    }
  
    if (arguments[0].innerText.match('JSON')) {
      // getSaveJson
      var obj = (sheet && sheet.getSaveJson({
        saveMode: savemode,
        col: column
      }));

      if (obj.Message == 'RequiredError') { delete obj.row; }
      this.strChanges = JSON.stringify(obj);
    } else if (arguments[0].innerText.match('문자열')) {
      // getSaveString
      this.strChanges = (sheet && sheet.getSaveString({
        saveMode: savemode,
        queryMode: querymode,
        urlEncode: urlencode,
        col: column,
        delim: delimeter
      }));

      if (this.strChanges == '') {
        this.strChanges = '데이터가 없거나, 수정된 데이터가 없습니다.';
      }
    } else if (arguments[0].innerText.match('저장1')) {
      // 실제 저장
      var url = arguments[1] == 1 ? '/samples/customer/save_success.jsp' : '/samples/customer/save_error.jsp';

      if (location.href.indexOf('localhost') > -1) {
        url = '../jsp' + url;
      } else {
        url = 'https://api.ibleaders.com/ibsheet/v8' + url;
      }

      sheet.doSave({
        url: 'COA_Auth_Insert',
        //param: 'sa_name=chris lee&sa_no=9800321',
        saveMode: 2,
        queryMode: 0,
       // urlEncode: urlencode,
        //reqHeader: { 'Content-Type': 'application/json' } ,
        //col: column,
        //delim: delimeter,
       // quest: true
      });
    }

   // parseData.value = this.strChanges || '';
  },
//조회 데이터
'data':''
}
ib.create();
// 외부 함수
function menuSave(item, data) {
  if (item.Value == 'DEL') {
    sheet.deleteRow({ row: item.Owner.Row });
  } else if (item.Value == 'INS') {
    sheet.addRow({ next: item.Owner.Row });
  }
}
var Auth_data = <?= json_encode($data);?> ;          
  var str_Channel_Kr =   '<?= $channel_Name_Kr?><?= $channel_code?>' ;        
  var str_Partner =   '<?= $Partner_Name_Kr?><?= $Partner_code?>' ;    
function exel_val()
{

  var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yyyy = today.getFullYear();

	if(dd < 10){
		dd = '0'+dd;
  	}
	if(mm < 10){
		mm = '0'+mm;
	}

	today = yyyy+mm+dd;   

  for(j=0;j< sheet.getTotalRowCount() ;j++)
  {
    val_check(sheet.getRowByIndex(j+1));
  }
}

function val_check(ROW)
{
  
 // var ROW = sheet.getRowByIndex(j+1);
            ROW["Bigo"] = "";
            //변경내용 확인            
          
            sheet.refreshCell({row:ROW, col:"Bigo"});
          
        if (sheet.getAttribute(ROW, null, "Color") == "#FF0000") 
        {
          alert("!");
        }
  
    if(ROW["Channel_Code"]==undefined ||   str_Channel_Kr.indexOf(ROW["Channel_Code"])<=0  )
    {
      sheet.setAttribute(ROW, "Channel_Code","Color" ,"#FF0000" );
      
      //var ROW = sheet.getRowByIndex(j+1);
            ROW["Bigo"] += "필수 코드 에러";
            //변경내용 확인            
            sheet.refreshCell({row:ROW, col:"Bigo"});
    }
    if (ROW["Partner_Code"]==undefined  ||   str_Partner.indexOf(ROW["Partner_Code"])<=0   )
    {
      sheet.setAttribute(ROW, "Partner_Code","Color" ,"#FF0000" );
      //var ROW = sheet.getRowByIndex(j+1);
            ROW["Bigo"] += "필수 코드 에러";
            //변경내용 확인            
            sheet.refreshCell({row:ROW, col:"Bigo"});
    }
    var date_end = IBSheet.dateToString(ROW["End_Date"], "yyyy-MM-dd");   
    var date2 = IBSheet.dateToString(new Date(), "yyyy-MM-dd");
    if (date_end < date2 ) {
          sheet.setAttribute( ROW,   "End_Date",    "Color",  "#FF0000"   );
        //var ROW = sheet.getRowByIndex(j + 1);
        ROW["Bigo"] += " 날짜 에러";
        //변경내용 확인
        sheet.refreshCell({row: ROW, col: "Bigo"});
    }   
    
    for(i=0;i< Auth_data.length ;i++)
    {
      if(ROW["Channel_Code"] ==  Auth_data[i]["Channel_Code"] && ROW["Channel_Stor_Name"] == Auth_data[i]["Channel_Stor_Name"] && ROW["Partner_Code"] ==  Auth_data[i]["Partner_Code"])
      { 
        if( IBSheet.dateToString(ROW["Start_Date"], "yyyyMMdd")==  Auth_data[i]["Start_Date"]) //기존 존재
        {
          sheet.setAttribute(sROW, "Start_Date","Color" ,"#FF0000" );
        //  var ROW = sheet.getRowByIndex(j+1);
            ROW["Bigo"] += "기존 존재 "+ Auth_data[i]["Auth_NO"];
            //변경내용 확인            
            sheet.refreshCell({row:ROW, col:"Bigo"});
        }
        if(  Auth_data[i]["End_Date"] > today ) // 날짜가 남아 있는 
        {
          sheet.setAttribute(ROW, "End_Date","Color" ,"#FF0000" );
         // var ROW = sheet.getRowByIndex(j+1);
            ROW["Bigo"] += "날짜 에러 "+ Auth_data[i]["Auth_NO"];
            //변경내용 확인            
            sheet.refreshCell({row:ROW, col:"Bigo"});
        }
      }
    } 
}

    </script>
</body>
</html>