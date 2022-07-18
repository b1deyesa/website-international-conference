var url    = SpreadsheetApp.openByUrl("https://docs.google.com/spreadsheets/d/1eVjc1vxyeNjfxP_fhYryD5wYKx6Ih8HRaKokqGya3nc/edit#gid=0");
var sheet  = url.getSheetByName("data");
var data   = sheet.getDataRange().getValues();
var row    = sheet.getLastRow() + 1;
var col    = 1;
var result = null;
var error  = null;
// -----------------------------------------------
var col_time_add    = 1;
var col_time_update = 2;
var col_code        = 3;
var col_email       = 4;
var col_name        = 5;
var col_article     = 6;                                                              // -- add variable --
// -----------------------------------------------

function getDataByCode(n) {
  for (var i = 1; i < data.length; i++) {
    if (data[i][2] == n) { result = data[i]; break; }
  } return result;
}
function getDataByEmail(n) {
  for (var i = 1; i < data.length; i++) {
    if (data[i][3] == n) { result = data[i]; break; }
  } return result;
}
function login(code) {
  var data = getDataByCode(code);
  if (data == null) { error = "Access code not registered"; }
  if (error == null) { 
    return { status: "success", data: data } 
  } else { 
    return { status: "error", message: error } 
  }
}
function regist(time_add, time_update, code, email, name) {
  if (getDataByEmail(email) != null) {
    return { status: "error", message: "Email already registered" }
  } else if (getDataByCode(code) != null) {
    return { status: "error", message: "Code already registered" }
  } else {
    var data = [[time_add,time_update,code,email,name]]; 
    var rowLength = data.length;
    var colLength = data[0].length;
    sheet.getRange(row, col, rowLength, colLength).setValues(data);
    return { status: "success", message: "Regist success" }
  }
}
function update(time_update, code, name, article) {                                   // -- add variable --
  if (getDataByCode(code) == null) {
    return { status: "error", message: "Code not found"}
  } else {
    for (var i = 1; i <= row; i++) {
      var value = sheet.getRange(i,3).getValue();
      if (value == code) {
        sheet.getRange(i,col_time_update).setValue(time_update);
        sheet.getRange(i,col_name).setValue(name);
        sheet.getRange(i,col_article).setValue(article);                              // -- add variable --
      }
    }
    return { status: "success", message: "Update success" }
  }
}
function doPost(e){
  var action = e.parameter.action;
  var time_add = e.parameter.time_add;
  var time_update = e.parameter.time_update;
  var code = e.parameter.code;
  var email = e.parameter.email;
  var name = e.parameter.name;
  var article = e.parameter.article;                                                  // -- add variable --
  
  if(action == "login") var result = login(code);
  if(action == "regist") var result = regist(time_add,time_update,code,email,name);
  if(action == "update") var result = update(time_update,code,name,article);          // -- add variable --
  
  return ContentService.createTextOutput(JSON.stringify(result));
}
function doGet(e) {
  return ContentService.createTextOutput(JSON.stringify({
    status: "error",
    message: "Method not allowed"
  }))
}