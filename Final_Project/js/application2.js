$(function(){
// define the application
var NoteKeeper = {};
var pictureSource;
var destinationType;
var isPhoneGapReady = false;
(function(app){
// variable definitions go here
var NoteLi = '<li ><a href="#pgEditNote?Title=LINK">ID</a></li>';
var NoteHdr = '<li data-role="list-divider">NoteHdr</li>';
var noNote = '<li id="noNote">You have no notes</li>';


app.init = function(){
FastClick.attach(document.body);
app.Notesbindings();
app.checkForNotesStorage();
app.BindDevice();
$('#msgboxyes').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var yesmethod = $('#msgboxyes').data('method');
var yesid = $('#msgboxyes').data('id');
app[yesmethod](yesid);
});

$('#msgboxno').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var toPage = $('#msgboxno').data('topage');
// show the page to display after a record is deleted
$.mobile.changePage('#'+toPage, {transition: 'slide'});
});

$('#alertboxok').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var toPage = $('#alertboxok').data('topage');
// show the page to display after ok is clicked
$.mobile.changePage('#'+toPage, {transition: 'slide'});
});

$(document).on('click', '#sbItems a', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var href = $(this).attr('href');
$.mobile.changePage(href, {transition: 'slide'});
});

};

app.Notesbindings = function(){
$(document).on('click', '#notesList a', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var href = $(this)[0].href.match(/\?.*$/)[0];
var Title = href.replace(/^\?Title=/,'');
$.mobile.changePage('#pgEditNote', {transition: 'slide'});
app.editNote(Title);
});

$(document).on('pagebeforechange', function(e, data){
var toPage = data.toPage[0].id;
if(toPage == 'pgNote'){
// restart the storage check
app.checkForNotesStorage();
}
});

// bind the back button of the list
$('#pgNoteBack').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
// move to the add new record screen
$.mobile.changePage('#pgMenu', {transition: 'slide'});
});
// click new on listing page
$('#pgNoteNew').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
$('#pgAddNote').data('from', pgNote);
// move to the add new record screen
$.mobile.changePage('#pgAddNote', {transition: 'slide'});
});
// click back button of new record page
$('#pgAddNoteBack').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
//which page are we coming from, if from sign in go back to it
var pgFrom = $('#pgAddNote').data('from');
switch (pgFrom) {
case "pgSignIn":
$.mobile.changePage('#pgSignIn', {transition: 'slide'});
break;
default:
// go back to the listing screen
$.mobile.changePage('#pgNote', {transition: 'slide'});
}
});
// click save button of new record
$('#pgAddNoteSave').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
// save the Note
var NoteRec;
NoteRec = pgAddNoteGetRec();
app.addNote(NoteRec);
});
// click back button of edit record page
$('#pgEditNoteBack').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
// go back to the listing screen
$.mobile.changePage('#pgNote', {transition: 'slide'});
});
// click update when editing a record
$('#pgEditNoteUpdate').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
// save the Note
var NoteRecNew;
NoteRecNew = pgEditNoteGetRec();
app.updateNote(NoteRecNew);
});
// click delete on edit page
$('#pgEditNoteDelete').on('click', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var Title = $('#pgEditNoteTitle').val();
Title = Title.replace(/-/g,' ');
Title = Title.replace(/-/g,' ');
$('#msgboxheader h1').text('Confirm Delete');
$('#msgboxtitle').text(Title);
$('#msgboxprompt').text('Are you sure that you want to delete this note?');
$('#msgboxyes').data('method', 'deleteNote');
Title = Title.replace(/ /g,'-');
$('#msgboxyes').data('id', Title);
$('#msgboxno').data('topage', 'pgEditNote');
$.mobile.changePage('#msgbox', {transition: 'pop'});

});





};
//get the record to be saved and put it in a record array
function pgAddNoteGetRec(){
//define the new record
var NoteRec
NoteRec = {};
NoteRec.Title = $('#pgAddNoteTitle').val();
NoteRec.Detail = $('#pgAddNoteDetail').val();
return NoteRec;
}

//get the record to be saved and put it in a record array
function pgEditNoteGetRec(){
//define the new record
var NoteRec
NoteRec = {};
NoteRec.Title = $('#pgEditNoteTitle').val();
NoteRec.Detail = $('#pgEditNoteDetail').val();
return NoteRec;
}

//clear the forms for new data entry
function pgAddNoteClear(){
$('#pgAddNoteTitle').val('');
$('#pgAddNoteDetail').val('');
}

//clear the forms for new data entry
function pgEditNoteClear(){
$('#pgEditNoteTitle').val('');
$('#pgEditNoteDetail').val('');
}





app.addNote = function(NoteRec){
// get Note records.
var NotesObj = app.getNotes();
// define a record object to store the current details
var Title = NoteRec.Title;
Title = Title.replace(/ /g,'-');
NotesObj[Title] = NoteRec;
localStorage['notekeeper-notes'] = JSON.stringify(NotesObj);
// clear the form fields
pgAddNoteClear();
//which page are we coming from, if from sign in go back to it
var pgFrom = $('#pgAddNote').data('from');
switch (pgFrom) {
case "pgSignIn":
$.mobile.changePage('#pgSignIn', {transition: 'slide'});
break;
}
};

app.editNote = function(Title){
// get Note records.
var NotesObj = app.getNotes();
// lookup specific Note
Title = Title.replace(/ /g,'-');
var NoteRec = NotesObj[Title];
$('#pgEditNote').data('url', Title);
$('#pgEditNoteDelete').data('href', Title);
$('#pgEditNoteTitle').attr('readonly', 'readonly');
$('#pgEditNoteTitle').attr('data-clear-btn', 'false');
$('#pgEditNoteTitle').val(NoteRec.Title);
$('#pgEditNoteDetail').val(NoteRec.Detail);
};

app.updateNote = function(NoteRecNew){
// get Note records.
var NotesObj = app.getNotes();
// lookup specific Note
var Title = NoteRecNew.Title;
Title = Title.replace(/ /g,'-');
var NoteRec = NotesObj[Title];
// assign new values to read record
NoteRec.Title = NoteRecNew.Title;
NoteRec.Detail = NoteRecNew.Detail;
NotesObj[Title] = NoteRec;
localStorage['notekeeper-notes'] = JSON.stringify(NotesObj);
// clear the form fields
pgEditNoteClear();
// show the page to display after a record is deleted
$.mobile.changePage('#pgNote', {transition: 'slide'});
};

app.deleteNote = function(Title){
// clear the set values// get the Note records from localStorage
var NotesObj = app.getNotes();
// delete selected Note
delete NotesObj[Title];
// write it back to localStorage
localStorage['notekeeper-notes'] = JSON.stringify(NotesObj);
// show the page to display after a record is deleted
$.mobile.changePage('#pgNote', {transition: 'slide'});
};

app.getNotes = function(){
// get Note records
var NotesObj = localStorage['notekeeper-notes'];
if (!NotesObj){
NotesObj = {};
localStorage['notekeeper-notes'] = JSON.stringify(NotesObj);
} else {
NotesObj = JSON.parse(NotesObj);
}
return NotesObj;
};

app.displayNotes = function(){
// get Note records.
var NotesObj = app.getNotes();
// create an empty string to contain html
var html = '';
// make sure your iterators are properly scoped
var n;
// loop over notes
for (n in NotesObj){
var nLnk = n.replace(/-/g,' ');
html += NoteLi.replace(/ID/g,nLnk).replace(/LINK/g,n);
}
$('#notesList').html(NoteHdr + html).listview('refresh');
};

app.checkForNotesStorage = function(){
var NotesObj = app.getNotes();
// are there existing Note records?
if (!$.isEmptyObject(NotesObj)) {
// yes there are. pass them off to be displayed
app.displayNotes();
} else {
// nope, just show the placeholder
$('#notesList').html(NoteHdr + noNote).listview('refresh');
}
};

app.BindDevice = function(){
document.addEventListener('deviceready', app.onDeviceReady, false);
};

app.onDeviceReady = function(){
pictureSource = navigator.camera.PictureSourceType;
destinationType = navigator.camera.DestinationType;
isPhoneGapReady = true;
};


app.init();
})(NoteKeeper);
});