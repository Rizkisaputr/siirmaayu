function checkAll()
{
var checks = document.getElementsByName('selected_tbl[]');
var boxLength = checks.length;

for (i = 0; i < boxLength; i++)
	checks[i].checked = true;
}

function uncheckAll()
{
var checks = document.getElementsByName('selected_tbl[]');
var boxLength = checks.length;

for (i = 0; i < boxLength; i++)
	checks[i].checked = false;
}