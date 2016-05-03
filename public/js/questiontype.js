       
        ChangeTemplate();

        //var c_multi = 4;

        var counters = new Array();
        var answer_count = 4;
        var answer_short_count = 1;
        counters["tblMulti"] = answer_count;
        counters["tblSingle"] = answer_count;
        counters["tblShort"] = answer_short_count;
        counters["tblMultiText"] = answer_count;

        function addRow(tableID, textboxID ) {

            counters[tableID]++;                        
                        
            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;
            
            for(var i=0; i<colCount; i++) {

                var newcell = row.insertCell(i);

                newcell.innerHTML = table.rows[0].cells[i].innerHTML.replace(new RegExp("1",'g'),counters[tableID]);
                //alert(newcell.childNodes[0].type);                
                //alert(newcell.innerHTML);
               
                switch(newcell.childNodes[0].type) {
                    case "text":                            
                            newcell.childNodes[0].value = "";
                            var txtname=newcell.childNodes[0].name;
                            var newname=txtname.substr(0,txtname.length-1)+counters[tableID];
                            // newcell.childNodes[0].id=newname;
                            newcell.childNodes[0].name=newname;
                            break;
                    case "checkbox":                    
                            newcell.childNodes[0].checked = false;
                            var chkname=newcell.childNodes[0].name;
                            var newname=chkname.substr(0,txtname.length-1)+counters[tableID];
                            // newcell.childNodes[0].id="chkMulti"+counters[tableID];
                            newcell.childNodes[0].name=newname;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            newcell.childNodes[0].value=counters[tableID];
                            break;
                    
                }
            }
            
        }

        function deleteRow(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            if(rowCount==1)
                {
                    alert('Cannot delete last choise');
                    return;
                }
            table.deleteRow(rowCount-1);
            counters[tableID]--;
        }

        function ChangeTemplate()
        {
            DisableAllTemplates();
            var val = document.getElementById('drpTemplate').options[document.getElementById('drpTemplate').selectedIndex].value;
            
            if(val == 'multichoice')
            {
                document.getElementById('trMulti').style.display="";
            }
            else if(val=='singlechoice')
            {
                  document.getElementById('trSingle').style.display="";
            }
            else if(val=='shortanswer')
            {
                  document.getElementById('trShort').style.display="";
            }
            else if(val==4)
            {
                  document.getElementById('trMultiText').style.display="";
            }
        }

        function DisableAllTemplates()
        {
            document.getElementById('trMulti').style.display="none";
            document.getElementById('trSingle').style.display="none";
            document.getElementById('trShort').style.display="none";
            // document.getElementById('trMultiText').style.display="none";
        }
