function EveryOtherClicked() {
	if (document.getElementById("days[5]").checked) {
		document.getElementById("days[0]").checked = false;
		document.getElementById("days[0]").disabled = true;
		document.getElementById("days[1]").checked = false;
		document.getElementById("days[1]").disabled = true;
		document.getElementById("days[2]").checked = false;
		document.getElementById("days[2]").disabled = true;
		document.getElementById("days[3]").checked = false;
		document.getElementById("days[3]").disabled = true;
		document.getElementById("days[4]").checked = false;
		document.getElementById("days[4]").disabled = true;
	} else {
		document.getElementById("days[0]").disabled = false;
		document.getElementById("days[1]").disabled = false;
		document.getElementById("days[2]").disabled = false;
		document.getElementById("days[3]").disabled = false;
		document.getElementById("days[4]").disabled = false;
	};
};

function HouseholdSelectorHashContent() {
	var strToReturn = new String(qc.getHashContent());

	if (strToReturn.indexOf('/') > -1) {
		strToReturn = strToReturn.substring(0, strToReturn.indexOf('/'));
	};

	return strToReturn;
};

function ScrollToBottom() {
	window.scroll(0, window.document.height);
};

function ScrollDivToBottom(strControlId) {
	var objDiv = document.getElementById(strControlId);
	objDiv.scrollTop = objDiv.scrollHeight;
};

function OpenInNewWindow(strUrl) {
	window.open(strUrl, 'CheckImage', 'height=500px,width=1100px,menubar=no,scrollbars=no,status=no,toolbar=no,directories=no,resizable=no');
};

function displayHelp(strID) {
	$.fx.speeds._default = 1000;
	
	$( "#"+strID ).dialog({
		autoOpen: false,
		show: "blind",
		hide: "explode"
	});
	
	$( "#"+strID ).dialog( "open" );		
}