var url = SpreadsheetApp.openByUrl("https://docs.google.com/spreadsheets/d/1H8tx1nhPYyvXmC7Ebg6k8LV95RIwSvzvTN9yPzBreBQ/edit#gid=0")
var sheet = url.getSheetByName("Participant data")
var data = sheet.getDataRange().getValues()
var row = sheet.getLastRow() + 1
var result = null
var error = null
// -----------------------------------------------
var col_time_add = 1
var col_time_update = 2
var col_code = 3
var col_email = 4
var col_name = 5
var col_phone = 6
var col_institution = 7
var col_status = 8
var col_payment = 9
var col_payment_status = 10
var col_article = 11
// -----------------------------------------------

function doGet(e) {
  return ContentService.createTextOutput(JSON.stringify({
    status: "error",
    message: "Method not allowed"
  }))
}
function doPost(e) {
  var action = e.parameter.action
  var code = e.parameter.code

  if (action == "login") var result = login(code)
  if (action == "regist") var result = regist(code, e)
  if (action == "update") var result = update(code, e)
  if (action == "read") var result = read()
  if (action == "paymentConfirm") var result = paymentConfirm(code)

  return ContentService.createTextOutput(JSON.stringify(result))
}
function getDataByCode(n) {
  for (var i = 1; i < data.length; i++) { if (data[i][2] == n) { result = data[i]; break } } return result
}
function getDataByEmail(n) {
  for (var i = 1; i < data.length; i++) { if (data[i][3] == n) { result = data[i]; break } } return result
}
function login(code) {
  var data = getDataByCode(code)
  if (data == null) { error = "Access code not registered" }
  if (error == null) { return { status: "success", data: data } }
  else { return { status: "error", message: error } }
}
function regist(code, e) {
  var time_add = e.parameter.time_add
  var time_update = e.parameter.time_update
  var email = e.parameter.email
  var name = e.parameter.name
  var status = e.parameter.status
  var payment_status = e.parameter.payment_status

  if (getDataByEmail(email) != null) { return { status: "error", message: "Email already registered" } }
  else if (getDataByCode(code) != null) { return { status: "error", message: "Please refresh and regist again" } }
  else {
    sheet.getRange(row, col_time_add).setValue(time_add)
    sheet.getRange(row, col_time_update).setValue(time_update)
    sheet.getRange(row, col_code).setValue(code)
    sheet.getRange(row, col_email).setValue(email)
    sheet.getRange(row, col_name).setValue(name)
    sheet.getRange(row, col_status).setValue(status)
    sheet.getRange(row, col_payment_status).setValue(payment_status)
    sendMail(code, email, name)
    return { status: "success", message: "Regist success, check your email" }
  }
}
function update(code, e) {
  var time_update = e.parameter.time_update
  var name = e.parameter.name
  var phone = e.parameter.phone
  var institution = e.parameter.institution
  var paymentName = e.parameter.paymentName
  var articleName = e.parameter.articleName

  if (getDataByCode(code) == null) { return { status: "error", message: "Code not found" } }
  else {
    for (var i = 1; i <= row; i++) {
      var value = sheet.getRange(i, col_code).getValue()
      if (value == code) {
        sheet.getRange(i, col_time_update).setValue(time_update)
        sheet.getRange(i, col_name).setValue(name)
        sheet.getRange(i, col_phone).setValue(phone)
        sheet.getRange(i, col_institution).setValue(institution)
        if (paymentName.length != 0 && sheet.getRange(i, col_payment).getValue() == '') {
          sheet.getRange(i, col_payment).setValue(uploadPayment(e))
          sheet.getRange(i, col_payment_status).setValue('processing')
        }
        if (articleName.length != 0) { sheet.getRange(i, col_article).setValue(uploadArticle(e)) }
      }
    }
    return { status: "success", message: "Update success", data: getDataByCode(code) }
  }
}
function read() {
  var data = sheet.getDataRange().getValues();
  var datas = []
  data.forEach(function (row) {
    datas.push(row)
  });
  return datas
}
function paymentConfirm(code) {
  for (var i = 1; i <= row; i++) {
    var value = sheet.getRange(i, col_code).getValue()
    if (value == code) {
      sheet.getRange(i, col_payment_status).setValue('paid')
    }
  }
  return { status: "success", message: "Payment Confirm", data: getDataByCode(code) }
}
function sendMail(code, email, name) {
  var sendTo = email
  var subject = "International Conference 2022"
  var message =
    "Dear " + name + ",\nThank you for registering to Conference ." +
    "We will send you a reminder on our website before the event.\n\n" +
    "Our website : https://ic.fpikunpatti.id \n" +
    "Your Access Code : " + code + "\n\n" +
    "Thank you again, and have great rest of the day."
  MailApp.sendEmail(sendTo, subject, message)
}
function uploadPayment(e) {
  var data = e.parameter.paymentFile;
  var file = e.parameter.paymentName;
  var dropbox = "Reciepts";
  var folder, folders = DriveApp.getFoldersByName(dropbox);
  folder = folders.next();
  var contentType = data.substring(5, data.indexOf(';')),
    bytes = Utilities.base64Decode(data.substr(data.indexOf('base64,') + 7)),
    blob = Utilities.newBlob(bytes, contentType, file);
  var file = folder.createFile(blob);
  var fileUrl = file.getUrl();
  return fileUrl;
}
function uploadArticle(e) {
  var data = e.parameter.articleFile;
  var file = e.parameter.articleName;
  var dropbox = "Article";
  var folder, folders = DriveApp.getFoldersByName(dropbox);
  folder = folders.next();
  var contentType = data.substring(5, data.indexOf(';')),
    bytes = Utilities.base64Decode(data.substr(data.indexOf('base64,') + 7)),
    blob = Utilities.newBlob(bytes, contentType, file);
  var file = folder.createFile(blob);
  var fileUrl = file.getUrl();
  return fileUrl;
}