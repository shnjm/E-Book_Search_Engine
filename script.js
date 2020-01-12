var ran = 0;
function notice_creat(data) {
	var dom = document.getElementById("notice");
	dom.innerHTML = data;
}

function notice_updt(data) {
	var dom = document.getElementById("notice");
	var str = "Database Update status..</br></br>";
	str = str + "File Added : " + data["files"] + "</br>";
	str = str + "</br>Time Requared : " + data["time"] + " seconds";
	dom.innerHTML = str;
}

function notice_clear(data) {
	var dom = document.getElementById("notice");
	var str = "Database Table status..</br>";
	var clr = "<div style='color:green;'>Cleared</div>"; var err = "<div style='color:red;'>Not Cleared</div>";
	str = str + "Link table : ";
	str = str + (data["link"] ? clr : err);
	str = str + "</br>File table : "
	str = str + (data["file"] ? clr : err);
	str = str + "</br>Keyword table : ";
	str = str + (data["keyword"] ? clr : err);
	str = str + "</br>Time Requared : " + data["time"] + " seconds.";
	dom.innerHTML = str;
}

function run_cmd(link) {
	var dom = document.getElementById("run");
	if (dom.children[0]) {
		dom.removeChild(dom.children[0]);
	}
	ran = ran + 1;
	var a = document.createElement("script");
	a.src = link + "&" + ran;
	dom.appendChild(a);
}

function run_cmd_u(link) {
	var dom = document.getElementById("notice");
	str = "Please wait. As it process many files it will take some times.";
	dom.innerHTML = str;
	run_cmd(link);
}

function fileOver(data) {
	var dom = document.getElementById("info");
	var str = "<img src='" + data["type"] + (data["type"] == "htm" ? "l" : "") + ".png" + "'></br>";
	str = str + "<b>File name: </b>" + data["name"] + "</br>";
	str = str + "<b>File link: </b>" + data["link"] + "</br>";
	str = str + "<b>File size: </b>" + data["size"];
	dom.innerHTML = str;

}

function chkSubmit() {
	var vlu = document.getElementById("query").value;
	vlu = vlu.trim();
	if (vlu == "" || vlu == " ") {
		alert("ERROR : Please enter some query word/s.");
		return false;
	}
	return true;
}

function file_key_clr(type) {
	if (type == "key") {
		key = document.getElementById("key").value;
		run_cmd("http://127.0.0.1/PhpProject1-test/function/file_key.php?key=" + key);
	}
	else if (type == "file") {
		key = document.getElementById("file").value;
		key = encodeURIComponent(key);
		run_cmd("http://127.0.0.1/PhpProject1-test/function/file_key.php?file=" + key);
	}
}

function notice_file_key(data) {
	var dom = document.getElementById("notice");
	var str = "Links had</br>" + data["link"] + "</br>";
	var clr = "<div style='color:green;'>Success</div>"; var err = "<div style='color:red;'>Not Success</div>";
	str = str + "Links clear : " + (data["clink"] == 1 ? clr : err) + "</br>";
	str = str + "\"" + data["who"] + "\" Clear : " + (data["cwho"] == 1 ? clr : err) + "</br>";
	dom.innerHTML = str;
}

function rnmFile() {
	var fl = document.getElementById("old").value;
	var ky = document.getElementById("new").value;
	fl = fl.trim();
	ky = ky.trim();
	if (fl == "" || fl == " " || ky == "" || ky == " ") {
		alert("ERROR : Please enter both value of old and new file name correctly.");
		return false;
	}
	fl = encodeURIComponent(fl);
	ky = encodeURIComponent(ky);
	run_cmd("http://127.0.0.1/PhpProject1-test/function/rnmFile.php?old=" + fl + "&new=" + ky);
}

function notice_rnmFile(data) {
	var dom = document.getElementById("notice");
	var clr = "<div style='color:green;'>Success</div>"; var err = "<div style='color:red;'>Not Success or no file such name.</div>";
	var str = "Rename function :</br>From : " + data["old"] + "</br>To : " + data["new"] + "</br>";
	str = str + "Status : " + (data["value"] == 1 ? clr : err);
	dom.innerHTML = str;
}
