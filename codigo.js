	var txt=[];
	var total=0;
	var bsM=0;
	var max=[];
	var id=0;
	var sorteo=[""];
	var animales = ["carnero","toro","ciempies","alacran","leon","rana","perico","raton","aguila","tigre","gato","caballo","mono","paloma","zorro","oso","pavo","burro","chivo","cochino","gallo","camello","zebra","iguana","gallina","vaca","perro","zamuro","elefante","caiman","lapa","ardilla","pescado","venado","jirafa","culebra","delfin","ballena"]
	var idR=1;
	pantalla=screen.width
	document.write('<link href="styleBlue.css" rel="stylesheet" type="text/css" media="screen" />');
	function mostrarTabla() {		
		document.getElementById("divNum").style.display="block"
		document.getElementById("showNum").style.display="block"
	}
	function cargarE($animal) {
		c=$animal+'a';
		maxA=parseInt(document.getElementById(c).value);
		var t=0;
		var bs=0;
		var loteria="";
		var min="<?php echo date('i');?>";
		var sorteoA="<?php echo sorteoActual();?>";
		if(bsM!=0){
			bs=bsM
		}else{
			for (var i = 0; i < document.montos.length; i++) {
				if ((document.montos[i].checked==1) ) {
					bsM=parseInt(document.montos[i].value)
				}
			}
		}
		mostrarTabla()
		e=0;
		for (var i = 0; i < document.loterias.length; i++) {
			if (document.loterias[i].checked==1){
				if(document.loterias[i].value==sorteoA){
					if((maxA+bsM)>10000){
						disponible=bsM-	((maxA+bsM)-10000)
						if(disponible>0){
							alert("Numero agotado, Disponibl	e "+disponible);
							bs=disponible;
							bsM=disponible;
						}else{
							alert("Numero agotado.");
							bs=0;
							bsM=0;
						}
					}
				}else{
					bsM=parseInt(document.getElementById("text2").value)
				}
				if(min<55){
					var animal=$animal
					var sorteo =  "<td><input id='ticketF' name ='sorteos[]' value="+document.loterias[i].value+" type='text'></td>"
					var numero =  "<td><input id='ticketF' name ='numeros[]' value="+animal+" type='text' style='width:25px;'></td>"
					var nombre =  "<td><input id='ticketF' value="+animales[$animal-1]+" type='text' style='width:60%;'></td>"
					var monto =   "<td><input id='ticketF' name ='montos[]'value="+bs+" type='text' style='width:40%;'></td>"
					var eliminar ="<td><button id='eliminar' type='button' onclick='quitar("+idR+","+parseInt(bs)+","+$animal+")'>"+idR+"</button></td>"
					var fila=sorteo+numero+nombre+monto+eliminar;
					idR+=1;
					total=total+parseInt(bs);
					var btn = document.createElement("TR");
					btn.innerHTML=fila;
					document.getElementById("showNum").insertBefore(btn,document.getElementById("showNum")[2]);  
					document.getElementsByName("total")[0].value=total;
					document.getElementById(c).value=maxA+bsM;
					document.getElementById(c).style.background="#76FF03"
					document.getElementById(c).style.color="#000"
					if($animal==37){
						txt.push("0x"+bs)
					}else{
						if($animal==38){
							txt.push("00x"+bs)
						}else{
							if($animal<10){
								txt.push($animal+"x"+bs)
							}else{
								txt.push($animal+"x"+bs)
							}
						}
					}
				}else{
					if(document.loterias[i].value!=sorteoA){
						document.getElementById("showNum").style.display="block"
						var animal=$animal
						var sorteo =  "<td><input id='ticketF' name ='sorteos[]' value="+document.loterias[i].value+" type='text'></td>"
						var numero =  "<td><input id='ticketF' name ='numeros[]' value="+animal+" type='text' style='width:25px;'></td>"
						var nombre =  "<td><input id='ticketF' value="+animales[$animal-1]+" type='text' style='width:55px;'></td>"
						var monto =   "<td><input id='ticketF' name ='montos[]'value="+bs+" type='text' style='width:40px;'></td>"
						var eliminar ="<td><button id='eliminar' type='button' onclick='quitar("+idR+","+parseInt(bs)+","+$animal+")'>"+idR+"</button></td>"
						var fila=sorteo+numero+nombre+monto+eliminar;
						idR+=1;
						total=total+parseInt(bs);
						var btn = document.createElement("TR");
						btn.innerHTML=fila;
						document.getElementById("showNum").appendChild(btn);
						document.getElementsByName("total")[0].value=total;
						if(document.loterias[i]==sorteoA){
							document.getElementById(c).value=maxA+bsM;
							document.getElementById(c).style.background="#76FF03"
							document.getElementById(c).style.color="#000"
						}
						if($animal==37){
							txt.push("0x"+bs)
						}else{
							if($animal==38){
								txt.push("00x"+bs)
							}else{
								if($animal<10){
									txt.push($animal+"x"+bs)
								}else{
									txt.push($animal+"x"+bs)
								}
							}
						}
					}else{
						alert("loteria Cerrada ");
						document.loterias[0].checked=0;
						document.loterias[1].checked=1;
					}
				}
			}
		}
		document.getElementById('text').focus();
	}
	function quitar(fila,bs,animal) {
		if(fila!==(document.getElementById("showNum").rows.length)){
			aux = animal+'x'+bs
			for (var i = 0; i < txt.length; i++) {
				if(txt[i]==aux){
					txt.splice(i,1);
				}
			}	
			total = total-bs
			document.getElementById("showNum").deleteRow(fila);
			document.getElementsByName("total")[0].value=total;
			document.getElementById('text').focus();
			idR-=1;
		}
	}
	function ocultar_loto(x){ 
		switch(x) {
			case 1:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 2:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 3:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 4:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 5:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 6:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 7:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
			break;
			case 8:
				document.loterias.elements[0].checked=1	
			break;
			case 9:
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 10:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 11:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 12:
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.getElementById("listaSorteos").deleteRow(0);
				document.loterias.elements[0].checked=1	
			break;
			case 10:
				document.getElementById("10am").style.display="none" ;
			break;
		}				
	} 
	function seleccionar_todo(x){ 
	   for (i=0;i<document.montos.elements.length;i++) 
	      if(document.montos.elements[i].type == "checkbox")
      		if(i==x){
	      	   document.montos.elements[i].checked=1 
      		}else{
	      	   document.montos.elements[i].checked=0 
      		}
	} 
	function imprimir(idA) {
		if(document.getElementsByName("total")[0].value>499){
			texto="";
			for (var i = 0; i < document.loterias.length; i++) {
				if(document.loterias[i].checked==1){
					sorteo.push(document.loterias[i].value)
				}
			}
			var myWindow = window.open("", "Ticket", "width=180,height=300");
			p="<p style='margin: 0;text-align:left; font-size:10px; text-transform:capitalize;'>";
			u="<p style='margin: 0;text-align:left; font-size:10px; text-transform:capitalize;'>";
			s=p+"AlmagencyMR. "+"<?php echo $horaT;?>";
			s+=p+"Ticket: "+(idA)+" - Serial: "+(idA*547);
			s+=p+"--------------------------------";
			s+=p+"Sorteo: lottoActivo "+sorteo[1];
			e=0;
			for (var i = 0; i <= txt.length-1; i++) {
				if(e==0){
					if(txt[i]!=""){
						texto+=p+txt[i];
						if(txt[i+1]!=""){
							texto+=" --- ";
						}
					}
					e++;
				}else{
					texto+=txt[i]+"</p>";
					e=0;
				}
			}
			s+=p+texto;
			s+=p+"--------------------------------";
			s+=p+"total bs: "+document.getElementsByName("total")[0].value;
			s+=p+"Revisar ticket. Valido (3) dias.";
			s+=p+".";
			s+=p+".";
			s+=p+".";
			s+=p+".";
			myWindow.document.write(s);
			myWindow.document.close();
			var i=1;
			if(i==1){
				myWindow.print();
				myWindow.close();
			}
		}
	}
	function monto(){
		k=window.event.keyCode
		if(k==13){
			if(document.getElementById("text").value!="" && parseInt(document.getElementById("text").value)>=0 && parseInt(document.getElementById("text").value)<=36){
				document.getElementById('text2').focus();
				document.getElementById('text2').select();
			}else{
				alert("Debe ingresar un numero entre 0-36");
			}
		}else{
			if((k==186) || (k==124)){
				document.getElementById('submitT').focus();
				document.getElementById("text").value="";
			}else{
				if(k==97){
					anularTicket()
				}else{
					if(k==112){
						pagarTicket()
					}else{
						if(k==107){
							listaTicket()
						}else{
							if(k==110){
								document.getElementById('nombre').focus();
								document.getElementById("text").value="";
							}else{
								if(k==118){
									document.getElementById('text').focus();
									manual()
								}else{
									if(k==114){
										document.getElementById('idRep').focus();
									}else{
										if(k==105){
											document.getElementById('inicio').focus();
										}else{
											if(k==116){
												document.getElementById('tickets').focus();
											}else{
												if(k==82){
													document.getElementById('resultados').focus();
												}else{
													if(k==103){
														document.getElementById('ganadores	').focus();
													}
												}
											}
										}
									}
								}
							}
						}
					}

				}

			}
		}
	}		
	function cargarManual(){
		if(window.event.keyCode==13){
			bsM=parseInt(document.getElementById("text2").value)
			if(document.getElementById("text2").value!="" && parseInt(document.getElementById("text2").value)>=100 && parseInt(document.getElementById("text2").value)<=10000){
				if(document.getElementById("text").value!=""){
					if(document.getElementById("text").value=="00"){
						cargarE(38);	
					}else{
						if(document.getElementById("text").value=="0"){
							cargarE(37);
						}else{
							cargarE(parseInt(document.getElementById("text").value));
						}	
					}
				}
				document.getElementById("text").value="";
				document.getElementById('text').focus();
			}else{
				alert("Monto invalido 100bs-10000bs")
				document.getElementById("text2").value="";
				document.getElementById('text2').focus();
			}
		}
	}
	function anularTicket(){	
		document.getElementById("contenAnular").style.display="block";
		document.getElementById("anular").focus();
	}
	function pagarTicket(){
		document.getElementById("contenPagar").style.display="block";
		document.getElementById("pagar").focus();
	}
	function listaTicket(){
		document.getElementById("showNumeros").style.display="none";
		document.getElementById("contenLista").style.display="block";
	}
	function manual(){
		document.getElementById("showNumeros").style.display="block";
		document.getElementById("contenLista").style.display="none";
		document.getElementById("contenAnular").style.display="none";
		document.getElementById("contenPagar").style.display="none";
	}
	function mostrarR(){
		if(document.getElementById("ruleta").style.display=="block"){
			document.getElementById("ruleta").style.display="none";
		}else{
			document.getElementById("ruleta").style.display="block";
		}
	}
