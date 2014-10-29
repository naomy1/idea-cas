/**
| ------------------------------------------------------------------------
|
| functions.js
|
| author	: Jorge Alberto Jaime
| date		: Aug 13 2012
| company	: Dirección de Educación Especial (SEP DF)
| 
| ------------------------------------------------------------------------
*/



/**
 * 
 * contentLoader
 * 
 * function to get the content and load into the
 * designed area for content.
 * 
 * @param string controller
 * @param string method
 * @param string designedArea
 * @param string getData
 * @param string postData
 * 
 */

function contentLoader (controller, method, designedArea, getData, postData) {
	
	// beg: if undefined variables
	if ( controller == undefined )
		controller = 'welcome';
	// ---------------------------------
	if ( method == undefined )
		method = 'index';
	// ---------------------------------
	if ( designedArea == undefined )
		designedArea = '.system-container';
	// ---------------------------------
	if ( getData == undefined )
		getData = '';
	else
		getData = '&' + getData;
	// ---------------------------------
	if ( postData == undefined )
		postData = '';
	// end: if undefined variables
	
	// beg: vars
	var		bodyMessenger		= $('.body-messenger'),
			systemSpiner		= $('.container-loader'),
			systemContainer		= $('.system-container');
	// end: vars
	
	// beg: ajax call
	bodyMessenger.fadeOut(0, function () {
		bodyMessenger.html('<span class="bar-message-alert">cargando&#133;</span>').fadeIn(0, function () {
			$.ajax({
				type		: 'POST',
				url			: __BASEPATH + '?c=' + controller + '&m=' + method + '' + getData + '',
				data		: postData,
				success		: function (successContentLoaderRequest) {
						$.ajax({
							type		: 'POST',
							url			: __BASEPATH + 'js/secundaria/jq.helper.js',
							success		: function (successJSHelperRequest) {
								$(designedArea).fadeOut(0, function () {
									$(this).html(successContentLoaderRequest).fadeIn(0);
								});
								bodyMessenger.fadeOut(0, function () {
									bodyMessenger.html('').fadeIn(0);
								});
							},
							error		: function (errorjqXHRJSHelperRequest, errorTxtJSHelperRequest, errorThrownJSHelperRequest) {
								bodyMessenger.html('<span class="bar-message-error">#' + errorjqXHRJSHelperRequest.status + ' ' + errorThrownJSHelperRequest + '</span>');
								setTimeout(function () {
									bodyMessenger.fadeOut(0, function () {
										bodyMessenger.html('').fadeIn(0);
									});
								}, 10000);
							}
						});
				},
				error		: function (errorjqXHRContentLoaderRequest, errorTxtContentLoaderRequest, errorThrownContentLoaderRequest) {
					bodyMessenger.html('<span class="bar-message-error">#' + errorjqXHRContentLoaderRequest.status + ' ' + errorThrownContentLoaderRequest + '</span>');
					setTimeout(function () {
						bodyMessenger.fadeOut(0, function () {
							bodyMessenger.html('').fadeIn(0);
						});
					}, 10000);
				}
			});
		});
	});
	// end: ajax call
}
// end: contentLoader





/**
 * 
 * lockFormFields
 * 
 * function to lock all field text when the system is busy
 */

function lockFormFields () {
	$('.form .form-row .row-field .ftext, .form .form-row .row-field .fselect').attr('disabled','disabled').addClass('disabled');
}





/**
 * 
 * unlockFormFields
 * 
 * function to lock all field text when the system is busy
 */

function unlockFormFields () {
	$('.form .form-row .row-field .ftext, .form .form-row .row-field .fselect').removeAttr('disabled','disabled').removeClass('disabled');
}





/**
 * 
 * markFields
 * 
 * function to mark or unmark fields with red border when
 * the data given in it are wrong
 * 
 * @param string field
 * @param string action
 */
function markFields (field, action) {
	
	if ( action != undefined && action != 'mark' && action != 'unmark' )
		action = 'mark';
	
	if ( action == undefined )
		action = 'mark';
	
	if ( field != undefined ) {
		
		switch ( action ) {
			case 'unmark':
				$(field).css('border-color', '#d0dadf');
				break;
			case 'mark':
			default:
				$(field).css('border-color', '#ed1c24');
		}
		
	}
}






/**
 * 
 * loginAttempt
 * 
 * function to attempt to login in the system
 */

function loginAttempt () {
		// beg: login-attempt
		
		var loginSpinner		= $('.form .form-login .form-actions .spinner-16x16'),
			loginSubmitButton	= $('.form .form-login .form-actions .button.submit'),
			loginFormMessenger	= $('.form .form-login .form-messenger'),
			username			= $('.form .form-login .form-row .row-field .ftext#login-username').val(),
			password			= $('.form .form-login .form-row .row-field .ftext#login-password').val(),
			loginData			= 'username=' + username + '&password=' + password + '';
			
		$('.form .form-login .form-row .row-field .ftext').attr('disabled','disabled').addClass('disabled');
		
		loginSpinner.css({
			'height' : loginSubmitButton.height(),
			'width' : loginSubmitButton.width(),
			'padding-top' : loginSubmitButton.css('padding-top') - 1,
			'padding-bottom' : loginSubmitButton.css('padding-bottom'),
			'padding-left' : loginSubmitButton.css('padding-left'),
			'padding-right' : loginSubmitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			loginSubmitButton.fadeOut(0, function () {
				lockFormFields();
				loginFormMessenger.slideUp(showtimer, function () {
					$.ajax({
						type		: 'POST',
						url			: __BASEPATH + '?c=secundaria_sessions&m=login_attempt',
						data		: loginData,
						success		: function (successLoginAttemptRequest) {
							loginFormMessenger.html(successLoginAttemptRequest).slideDown(showtimer);
						},
						error		: function (errorLoginAttemptRequest, errorTxtLoginAttemptRequest, thrownLoginAttemptRequest) {
							loginFormMessenger.html('<span class="bar-error">' + errorLoginAttemptRequest.status + ' ' + thrownLoginAttemptRequest + '</span>').slideDown(showtimer);
							setTimeout(function () {
								loginSpinner.fadeOut(0, function () {
									loginSubmitButton.fadeIn(0);
								});
							}, showtimer);
							
						}
					});
				});
			});
		});
		// end: login-attempt
}
// end: loginAttempt





/**
 * 
 * forgotPasswdAttempt
 */
function forgotPasswdAttempt () {
		var forgotPasswdSpinner			= $('.form .form-forgotpasswd .form-actions .spinner-16x16'),
			forgotPasswdSubmitButton	= $('.form .form-forgotpasswd .form-actions .button.submit'),
			forgotPasswdFormMessenger	= $('.form .form-forgotpasswd .form-messenger'),
			usermail					= $('.form .form-forgotpasswd .form-row .row-field .ftext#forgotpasswd-usermail').val(),
			forgotPasswdData			= 'usermail=' + usermail + '';
			
		$('.form .form-forgotpasswd .form-row .row-field .ftext').attr('disabled','disabled').addClass('disabled');
		
		forgotPasswdSpinner.css({
			'height' : forgotPasswdSubmitButton.height(),
			'width' : forgotPasswdSubmitButton.width(),
			'padding-top' : forgotPasswdSubmitButton.css('padding-top') - 1,
			'padding-bottom' : forgotPasswdSubmitButton.css('padding-bottom'),
			'padding-left' : forgotPasswdSubmitButton.css('padding-left'),
			'padding-right' : forgotPasswdSubmitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			forgotPasswdSubmitButton.fadeOut(0, function () {
				lockFormFields();
				
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_sessions&m=forgotpasswd_attempt',
					data		: forgotPasswdData,
					success		: function (successForgotPasswdAttemptRequest) {
						forgotPasswdFormMessenger.slideUp(showtimer, function () {
							forgotPasswdFormMessenger.html(successForgotPasswdAttemptRequest).slideDown(showtimer);
						});
						forgotPasswdSpinner.fadeOut(0, function () {
							forgotPasswdSubmitButton.fadeIn(0);
						});
						$('.form .form-forgotpasswd .form-row .row-field .ftext').removeAttr('disabled').removeClass('disabled');
					},
					error		: function (errorjqXHRForgotPasswdAttemptRequest, errorTxtForgotPasswdAttemptRequest, errorThrownForgotPasswdAttemptRequest) {
						forgotPasswdFormMessenger.slideUp(showtimer, function () {
							forgotPasswdFormMessenger.html('<span class="bar-error">' + errorjqXHRForgotPasswdAttemptRequest.status + ' ' + errorThrownForgotPasswdAttemptRequest + '</span>').slideDown(showtimer);
						});
						forgotPasswdSpinner.fadeOut(0, function () {
							forgotPasswdSubmitButton.fadeIn(0);
						});
						$('.form .form-forgotpasswd .form-row .row-field .ftext').removeAttr('disabled').removeClass('disabled');
					}
				});
				
			});
		});
}
// end: forgotPasswdAttempt





/**
 * 
 * loginAttempt
 * 
 * function to attempt to login in the system
 */

function registerUserAttempt () {
	var registerSpinner			= $('.form .form-registeruser .form-actions .spinner-16x16'),
		registerSubmitButton	= $('.form .form-registeruser .form-actions .button.submit'),
		registerFormMessenger	= $('.form .form-registeruser .form-messenger'),
		firstnames				= $('.form .form-registeruser .form-row .row-field .ftext#register-firstnames').val(),
		lastnames				= $('.form .form-registeruser .form-row .row-field .ftext#register-lastnames').val(),
		useremail				= $('.form .form-registeruser .form-row .row-field .ftext#register-useremail').val(),
		usercurp				= $('.form .form-registeruser .form-row .row-field .ftext#register-usercurp').val(),
		userusaer				= $('.form .form-registeruser .form-row .row-field .ftext#register-userusaer').val(),
		userusaerzone			= $('.form .form-registeruser .form-row .row-field .ftext#register-userusaerzone').val(),
		usercrosee				= $('.form .form-registeruser .form-row .row-field .fselect#register-usercrosee').val(),
		username				= $('.form .form-registeruser .form-row .row-field .ftext#register-username').val(),
		password				= $('.form .form-registeruser .form-row .row-field .ftext#register-password').val(),
		repasswd				= $('.form .form-registeruser .form-row .row-field .ftext#register-repasswd').val(),
		registerData			= 'firstnames=' + firstnames + '&lastnames=' + lastnames + '&useremail=' + useremail + '&usercurp=' + usercurp + '&userusaer=' + userusaer + '&userusaerzone=' + userusaerzone + '&usercrosee=' + usercrosee + '&username=' + username + '&password=' + password + '&repasswd=' + repasswd + '';
		
	$('.form .form-registeruser .form-row .row-field .ftext').attr('disabled','disabled').addClass('disabled');
	
	registerSpinner.css({
		'height' : registerSubmitButton.height(),
		'width' : registerSubmitButton.width(),
		'padding-top' : registerSubmitButton.css('padding-top') - 1,
		'padding-bottom' : registerSubmitButton.css('padding-bottom'),
		'padding-left' : registerSubmitButton.css('padding-left'),
		'padding-right' : registerSubmitButton.css('padding-right'),
		'border' : '1px solid transparent',
		'display' : 'inline-block'
	}).fadeIn(0, function () {
		registerSubmitButton.fadeOut(0, function () {
			lockFormFields();
			registerFormMessenger.slideUp(showtimer, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_sessions&m=registeruser_attempt',
					data		: registerData,
					success		: function (successRegisteruserAttemptRequest) {
						registerFormMessenger.html(successRegisteruserAttemptRequest).slideDown(showtimer);
					},
					error		: function (errorRegisteruserAttemptRequest, errorTxtRegisteruserAttemptRequest, thrownRegisteruserAttemptRequest) {
						registerFormMessenger.html('<span class="bar-error">' + errorRegisteruserAttemptRequest.status + ' ' + thrownRegisteruserAttemptRequest + '</span>').slideDown(showtimer);
						setTimeout(function () {
							registerSpinner.fadeOut(0, function () {
								registerSubmitButton.fadeIn(0);
							});
							unlockFormFields();
						}, showtimer);
					}
				});
			});
		});
	});
}
// end: loginAttempt





/**
 * 
 * loadWindow
 * 
 * function to load data into the floating window
 * 
 * @param string controller
 * @param string method
 */

function loadWindow (controller, method, dataPOST, dataGET) {
	
	if ( controller != undefined ) {
	
		if ( method == undefined )
			method = 'index';
		
		if ( dataPOST == undefined )
			dataPOST = '';
		
		if ( dataGET != undefined )
			dataGET = '&' + dataGET;
		else
			dataGET = '';
	
		var tableStr =		'<span class="window-layer">' +
							'<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">' +
							'<span class="window-container">' +
								'<span style="display: inline-block; padding-top: 5px; padding-bottom: 3px; padding-left: 10px; padding-right: 10px;">cargando&#133;</span>' +
							'</span>' +
							'</td></tr></table>' +
							'</span>';
		$('body').unbind('keyup').keyup(function (e) {
			if ( e.keyCode == 27 ){
				closeWindow();
			}
		});
		$('.body-container').fadeTo(showtimer, '0.4', function () {
			$('body').prepend(tableStr);
			$.ajax({
				type		: 'POST',
				url			: __BASEPATH + '?c=' + controller + '&m=' + method + '' + dataGET + '',
				data		: dataPOST,
				success		: function (successLoadWindowRequest) {
					
					$.ajax({
						type		: 'GET',
						url			: __BASEPATH + 'js/secundaria/jq.window.js',
						success		: function (successWindowJSRequest) {
							$('.window-layer .window-container').fadeOut(0, function () {
								$(this).html(successLoadWindowRequest).fadeIn(0);
							});
						},
						error		: function (errorWindowJSRequest, errorTxtWindowJSRequest, errorThrownWindowJSRequest) {
							$('.window-layer .window-container').fadeOut(0, function () {
								$(this).html('<span class="box-error" style="margin-bottom: 0px;">' + errorWindowJSRequest.status + ' ' + errorThrownWindowJSRequest + '</span>').fadeIn(0);
							});
							setTimeout(function () {
								closeWindow();
							}, 4000);
						}
					});
				},
				error		: function (errorLoadwindowRequest, errorTxtLoadwindowRequest, errorThrownLoadwindowRequest) {
					$('.window-layer .window-container').fadeOut(0, function () {
						$(this).html('<span class="box-error" style="margin-bottom: 0px;">' + errorLoadwindowRequest.status + ' ' + errorThrownLoadwindowRequest + '</span>').fadeIn(0);
					});
					setTimeout(function () {
						closeWindow();
					}, 4000);
				}
			});
		});
		
	}
}
// end: loadWindow





/**
 * 
 * closeWindow
 * 
 * function to close window
 */

function closeWindow() {
	$('.window-layer').fadeTo(showtimer, '0', function (){
		$(this).remove();
		$('.body-container').fadeTo(showtimer, '1');
	});
}





/**
 * 
 * lockWindow
 * 
 * 
 */
function lockWindow () {
	$('body').unbind('keyup');
}





/**
 * 
 * editProfileAttempt
 * 
 * function to send a request to edit user info
 */
function editProfileAttempt () {
	
	var		edituser_submitButton		= $('.form .form-edituserinfo .form-actions .button.submit'),
			edituser_userid				= $('.form .form-edituserinfo input[type=hidden]#edituser-userid').val(),
			edituser_firstname			= $('.form .form-edituserinfo .form-row .row-field .ftext#edituser-firstname').val(),
			edituser_lastname			= $('.form .form-edituserinfo .form-row .row-field .ftext#edituser-lastname').val(),
			edituser_useremail			= $('.form .form-edituserinfo .form-row .row-field .ftext#edituser-usermail').val(),
			edituser_usercurp			= $('.form .form-edituserinfo .form-row .row-field .ftext#edituser-usercurp').val(),
			edituser_userusaer			= $('.form .form-edituserinfo .form-row .row-field .ftext#edituser-userusaer').val(),
			edituser_userusaerzone		= $('.form .form-edituserinfo .form-row .row-field .ftext#edituser-userusaerzone').val(),
			edituser_usercrosee			= $('.form .form-edituserinfo .form-row .row-field .fselect#edituser-usercrosee').val(),
			edituser_form_messenger		= $('.form .form-edituserinfo .form-messenger'),
			edituser_spiner				= $('.form .form-edituserinfo .form-actions .spinner-16x16'),
			edituser_postdata			= 'userid=' + edituser_userid + '&firstname=' + edituser_firstname + '&lastname=' + edituser_lastname + '&useremail=' + edituser_useremail + '&usercurp=' + edituser_usercurp + '&userusaer=' + edituser_userusaer + '&userusaerzone=' + edituser_userusaerzone + '&usercrosee=' + edituser_usercrosee + '';
	
	
	edituser_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		edituser_spiner.css({
			'height' : edituser_submitButton.height(),
			'width' : edituser_submitButton.width(),
			'padding-top' : edituser_submitButton.css('padding-top') - 1,
			'padding-bottom' : edituser_submitButton.css('padding-bottom'),
			'padding-left' : edituser_submitButton.css('padding-left'),
			'padding-right' : edituser_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			edituser_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_users&m=useredit_attempt',
					data		: edituser_postdata,
					success		: function (successEditProfileRequest) {
						edituser_form_messenger.slideUp(showtimer, function () {
							edituser_form_messenger.html(successEditProfileRequest).slideDown(showtimer);
						});
					},
					error		: function (errorEditProfileRequest, errorTxtEditProfileRequest, errorThrownEditProfileRequest) {
						edituser_form_messenger.slideUp(showtimer, function () {
							edituser_form_messenger.html('<span class="bar-error">' + errorEditProfileRequest.status + ' ' + errorThrownEditProfileRequest + '</span>').slideDown(showtimer);
							edituser_spiner.fadeOut(0, function () {
								edituser_submitButton.fadeIn(0);
							});
						});
					}
				});
			});
		});
	});
}
// end: editProfileAttempt





/** 
 *
 * editPasswdAttempt
 * 
 * function to attepmt to update the user password
 */
function editPasswdAttempt () {
	var	editpasswd_submitButton			= $('.form .form-editpasswd .form-actions .button.submit'),
		editpasswd_form_messenger		= $('.form .form-editpasswd .form-messenger'),
		editpasswd_spiner				= $('.form .form-editpasswd .form-actions .spinner-16x16'),
		editpasswd_passwd_actual		= $('.form .form-editpasswd .form-row .row-field .ftext#editpasswd-actual').val(),
		editpasswd_passwd_new			= $('.form .form-editpasswd .form-row .row-field .ftext#editpasswd-new').val(),
		editpasswd_passwd_renew			= $('.form .form-editpasswd .form-row .row-field .ftext#editpasswd-renew').val(),
		editpasswd_userid				= $('.form .form-editpasswd input[type=hidden]#editpasswd-userid').val(),
		editpasswd_postdata				= 'userid=' + editpasswd_userid + '&passwd_actual=' + editpasswd_passwd_actual + '&passwd_new=' + editpasswd_passwd_new + '&passwd_renew=' + editpasswd_passwd_renew + '';
	editpasswd_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		editpasswd_spiner.css({
			'height' : editpasswd_submitButton.height(),
			'width' : editpasswd_submitButton.width(),
			'padding-top' : editpasswd_submitButton.css('padding-top') - 1,
			'padding-bottom' : editpasswd_submitButton.css('padding-bottom'),
			'padding-left' : editpasswd_submitButton.css('padding-left'),
			'padding-right' : editpasswd_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			editpasswd_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_users&m=passwdedit_attempt',
					data		: editpasswd_postdata,
					success		: function (successEditPasswdRequest) {
						editpasswd_form_messenger.slideUp(showtimer, function () {
							editpasswd_form_messenger.html(successEditPasswdRequest).slideDown(showtimer);
						});
					},
					error		: function (errorEditPasswdRequest, errorTxtEditPasswdRequest, errorThrownEditPasswdRequest) {
						editpasswd_form_messenger.slideUp(showtimer, function () {
							editpasswd_form_messenger.html('<span class="bar-error">' + errorEditPasswdRequest.status + ' ' + errorThrownEditPasswdRequest + '</span>').slideDown(showtimer);
							editpasswd_spiner.fadeOut(0, function () {
								editpasswd_submitButton.fadeIn(0);
							});
						});
					}
				});
			});
		});
	});
}
// end: editPasswdAttempt





/**
 *
 * deleteSchoolAttempt
 *
 * function to delete a school
 * 
 * @param Integer schoolID
 */

function deleteSchoolAttempt (schoolID, schoolName) {
	if ( schoolID != undefined ) {
		
		if ( schoolName == undefined )
			schoolName = 'Unamed School';
		
		var		tableRow			= $('.table.table-schools .table-rows#schoolid_' + schoolID + ''),
				tableRows			= $('.table.table-schools .table-list .table-rows');
				oldColor			= tableRow.css('background-color'),
				bodyMessenger		= $('.body-messenger'),
				dashboardMessenger	= $('.dashboard-messenger');
		tableRow.css('background-color', '#ed1c24');
		if ( confirm ('¿Realmente desea eliminar la escuela "' + schoolName + '"?') ) {
			bodyMessenger.html('<span class="bar-message-alert">cargando&#133;</span>').fadeIn(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_schools&m=deleteSchool_attempt',
					data		: 'schoolID=' + schoolID + '',
					success		: function (successContentLoaderRequest) {
						
						tableRow.slideUp(showtimer, function () {
							tableRow.remove();
							dashboardMessenger.slideUp(showtimer, function () {
								dashboardMessenger.html('<span class="bar-success" style="margin-top: 10px;">La escuela <b>"' + schoolName + '"</b> ha sido eliminada.</span>').slideDown(showtimer, function () {
									if ( dashboardTimeOut != undefined )
										clearTimeout(dashboardTimeOut);
									
									var dashboardTimeOut = setTimeout(function () {
										dashboardMessenger.slideUp(showtimer);
									}, 10000);
									
									var rowcounter = 0;
									$('.table-rows').each(function () {
										var row = $(this);
										row.removeClass('odd');
										if ( rowcounter == 1 ) {
											row.addClass('odd');
											rowcounter = 0;
										}
										else if ( rowcounter == 0 )
											rowcounter = 1;
									});
								});
							});
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
							if ( (tableRows.length - 1) == 0 ) {
								$('.table.table-schools .table-list').html('<span class="table-rows empty-row">Usted no ha registrado ninguna escuela</span>');
							}
						});
						
					},
					error		: function (errorjqXHRContentLoaderRequest, errorTxtContentLoaderRequest, errorThrownContentLoaderRequest) {
						bodyMessenger.html('<span class="bar-message-error">#' + errorjqXHRContentLoaderRequest.status + ' ' + errorThrownContentLoaderRequest + '</span>');
						setTimeout(function () {
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
						}, 10000);
					}
				});
			});
		}
		else
			tableRow.css('background-color', oldColor);
	}
}
// end: deleteSchoolAttempt





/**
 *
 * addSchoolAttepmt
 * 
 * function to attempt to add new school
 */

function addSchoolAttepmt () {
	var		addschool_submitButton			= $('.form .form-addschool .form-actions .button.submit'),
			addschool_form_messenger		= $('.form .form-addschool .form-messenger'),
			addschool_spiner				= $('.form .form-addschool .form-actions .spinner-16x16'),
			addschool_cct					= $('.form .form-addschool .form-row .row-field .ftext#addschool-cct').val(),
			addschool_name					= $('.form .form-addschool .form-row .row-field .ftext#addschool-name').val(),
			addschool_address				= $('.form .form-addschool .form-row .row-field .ftext#addschool-address').val(),
			addschool_colony				= $('.form .form-addschool .form-row .row-field .ftext#addschool-colony').val(),
			addschool_delegation			= $('.form .form-addschool .form-row .row-field .fselect#addschool-delegation').val(),
			addschool_zipcode				= $('.form .form-addschool .form-row .row-field .ftext#addschool-zipcode').val(),
			addschool_phone					= $('.form .form-addschool .form-row .row-field .ftext#addschool-phone').val(),
			addschool_supervisionzone		= $('.form .form-addschool .form-row .row-field .ftext#addschool-supervisionzone').val(),
			addschool_usaer					= $('.form .form-addschool .form-row .row-field .ftext#addschool-usaer').val(),
			addschool_usaer_supervisionzone	= $('.form .form-addschool .form-row .row-field .ftext#addschool-usaer-supervisionzone').val(),
			addschool_turn					= $('.form .form-addschool .form-row .row-field .fselect#addschool-turn').val(),
			addschool_grade_one				= $('.form .form-addschool .form-row .row-field .ftext#addschool-grade-one').val(),
			addschool_grade_two				= $('.form .form-addschool .form-row .row-field .ftext#addschool-grade-two').val(),
			addschool_grade_three			= $('.form .form-addschool .form-row .row-field .ftext#addschool-grade-three').val(),
			addschool_postdata				=	'cct=' + addschool_cct +
												'&name=' + addschool_name +
												'&address=' + addschool_address +
												'&colony=' + addschool_colony +
												'&delegation=' + addschool_delegation +
												'&zipcode=' + addschool_zipcode +
												'&phone=' + addschool_phone +
												'&supervisionzone=' + addschool_supervisionzone +
												'&usaer=' + addschool_usaer +
												'&usaer_supervisionzone=' + addschool_usaer_supervisionzone +
												'&turn=' + addschool_turn +
												'&grade_one=' + addschool_grade_one +
												'&grade_two=' + addschool_grade_two +
												'&grade_three=' + addschool_grade_three + '';
	
	addschool_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		addschool_spiner.css({
			'height' : addschool_submitButton.height(),
			'width' : addschool_submitButton.width(),
			'padding-top' : addschool_submitButton.css('padding-top') - 1,
			'padding-bottom' : addschool_submitButton.css('padding-bottom'),
			'padding-left' : addschool_submitButton.css('padding-left'),
			'padding-right' : addschool_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			addschool_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_schools&m=addschool_attempt',
					data		: addschool_postdata,
					success		: function (successAddSchoolRequest) {
						addschool_form_messenger.slideUp(showtimer, function () {
							addschool_form_messenger.html(successAddSchoolRequest).slideDown(showtimer);
						});
					},
					error		: function (errorAddSchoolRequest, errorTxtAddSchoolRequest, errorThrownAddSchoolRequest) {
						addschool_form_messenger.slideUp(showtimer, function () {
							addschool_form_messenger.html('<span class="bar-error">' + errorAddSchoolRequest.status + ' ' + errorThrownAddSchoolRequest + '</span>').slideDown(showtimer);
							addschool_spiner.fadeOut(0, function () {
								addschool_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// edn: addSchoolAttempt





/**
 * 
 * editSchoolAttempt
 * 
 * function to send a request to edit school information
 */
function editSchoolAttempt () {
	var		editschool_submitButton				= $('.form .form-editschool .form-actions .button.submit'),
			editschool_form_messenger			= $('.form .form-editschool .form-messenger'),
			editschool_spiner					= $('.form .form-editschool .form-actions .spinner-16x16'),
			editschool_id						= $('.form .form-editschool input[type=hidden]#editschool-schoolid').val(),
			editschool_cct						= $('.form .form-editschool .form-row .row-field .ftext#editschool-cct').val(),
			editschool_name						= $('.form .form-editschool .form-row .row-field .ftext#editschool-name').val(),
			editschool_address					= $('.form .form-editschool .form-row .row-field .ftext#editschool-address').val(),
			editschool_colony					= $('.form .form-editschool .form-row .row-field .ftext#editschool-colony').val(),
			editschool_delegation				= $('.form .form-editschool .form-row .row-field .fselect#editschool-delegation').val(),
			editschool_zipcode					= $('.form .form-editschool .form-row .row-field .ftext#editschool-zipcode').val(),
			editschool_phone					= $('.form .form-editschool .form-row .row-field .ftext#editschool-phone').val(),
			editschool_supervisionzone			= $('.form .form-editschool .form-row .row-field .ftext#editschool-supervisionzone').val(),
			editschool_usaer					= $('.form .form-editschool .form-row .row-field .ftext#editschool-usaer').val(),
			editschool_usaer_supervisionzone	= $('.form .form-editschool .form-row .row-field .ftext#editschool-usaer-supervisionzone').val(),
			editschool_turn						= $('.form .form-editschool .form-row .row-field .fselect#editschool-turn').val(),
			editschool_postdata					=	'schoolID=' + editschool_id +
													'&cct=' + editschool_cct +
													'&name=' + editschool_name +
													'&address=' + editschool_address +
													'&colony=' + editschool_colony +
													'&delegation=' + editschool_delegation +
													'&zipcode=' + editschool_zipcode +
													'&phone=' + editschool_phone +
													'&supervisionzone=' + editschool_supervisionzone +
													'&usaer=' + editschool_usaer +
													'&usaer_supervisionzone=' + editschool_usaer_supervisionzone +
													'&turn=' + editschool_turn + '';
	
	editschool_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		editschool_spiner.css({
			'height' : editschool_submitButton.height(),
			'width' : editschool_submitButton.width(),
			'padding-top' : editschool_submitButton.css('padding-top') - 1,
			'padding-bottom' : editschool_submitButton.css('padding-bottom'),
			'padding-left' : editschool_submitButton.css('padding-left'),
			'padding-right' : editschool_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			editschool_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_schools&m=editSchool_attempt',
					data		: editschool_postdata,
					success		: function (successeditschoolRequest) {
						editschool_form_messenger.slideUp(showtimer, function () {
							editschool_form_messenger.html(successeditschoolRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditschoolRequest, errorTxteditschoolRequest, errorThrowneditschoolRequest) {
						editschool_form_messenger.slideUp(showtimer, function () {
							editschool_form_messenger.html('<span class="bar-error">' + erroreditschoolRequest.status + ' ' + errorThrowneditschoolRequest + '</span>').slideDown(showtimer);
							editschool_spiner.fadeOut(0, function () {
								editschool_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: editSchoolAttempt





/**
 * 
 * editSchoolAttempt_root
 * 
 * function to send a request to edit school information
 */
function editSchoolAttempt_root () {
	var		editschool_submitButton				= $('.form .form-editschool-root .form-actions .button.submit'),
			editschool_form_messenger			= $('.form .form-editschool-root .form-messenger'),
			editschool_spiner					= $('.form .form-editschool-root .form-actions .spinner-16x16'),
			editschool_id						= $('.form .form-editschool-root input[type=hidden]#editschool-schoolid').val(),
			editschool_cct						= $('.form .form-editschool-root .form-row .row-field .ftext#editschool-cct').val(),
			editschool_name						= $('.form .form-editschool-root .form-row .row-field .ftext#editschool-name').val(),
			editschool_address					= $('.form .form-editschool-root .form-row .row-field .ftext#editschool-address').val(),
			editschool_colony					= $('.form .form-editschool-root .form-row .row-field .ftext#editschool-colony').val(),
			editschool_delegation				= $('.form .form-editschool-root .form-row .row-field .fselect#editschool-delegation').val(),
			editschool_zipcode					= $('.form .form-editschool-root .form-row .row-field .ftext#editschool-zipcode').val(),
			editschool_phone					= $('.form .form-editschool-root .form-row .row-field .ftext#editschool-phone').val(),
			editschool_supervisionzone			= $('.form .form-editschool-root .form-row .row-field .ftext#editschool-supervisionzone').val(),
			editschool_usaer					= $('.form .form-editschool-root .form-row .row-field .ftext#editschool-usaer').val(),
			editschool_usaer_supervisionzone	= $('.form .form-editschool-root .form-row .row-field .ftext#editschool-usaer-supervisionzone').val(),
			editschool_turn						= $('.form .form-editschool-root .form-row .row-field .fselect#editschool-turn').val(),
			editschool_postdata					=	'schoolID=' + editschool_id +
													'&cct=' + editschool_cct +
													'&name=' + editschool_name +
													'&address=' + editschool_address +
													'&colony=' + editschool_colony +
													'&delegation=' + editschool_delegation +
													'&zipcode=' + editschool_zipcode +
													'&phone=' + editschool_phone +
													'&supervisionzone=' + editschool_supervisionzone +
													'&usaer=' + editschool_usaer +
													'&usaer_supervisionzone=' + editschool_usaer_supervisionzone +
													'&turn=' + editschool_turn + '';
	
	editschool_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		editschool_spiner.css({
			'height' : editschool_submitButton.height(),
			'width' : editschool_submitButton.width(),
			'padding-top' : editschool_submitButton.css('padding-top') - 1,
			'padding-bottom' : editschool_submitButton.css('padding-bottom'),
			'padding-left' : editschool_submitButton.css('padding-left'),
			'padding-right' : editschool_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			editschool_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=edit_school_attempt',
					data		: editschool_postdata,
					success		: function (successeditschoolRequest) {
						editschool_form_messenger.slideUp(showtimer, function () {
							editschool_form_messenger.html(successeditschoolRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditschoolRequest, errorTxteditschoolRequest, errorThrowneditschoolRequest) {
						editschool_form_messenger.slideUp(showtimer, function () {
							editschool_form_messenger.html('<span class="bar-error">' + erroreditschoolRequest.status + ' ' + errorThrowneditschoolRequest + '</span>').slideDown(showtimer);
							editschool_spiner.fadeOut(0, function () {
								editschool_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: editSchoolAttempt_root





/**
 * 
 * editgroup
 * 
 * function to add group to the database
 */
function addGroupAttepmt () {
	var		addgroup_submitButton				= $('.form .form-addgroup .form-actions .button.submit'),
			addgroup_form_messenger				= $('.form .form-addgroup .form-messenger'),
			addgroup_spiner						= $('.form .form-addgroup .form-actions .spinner-16x16'),
			addgroup_schoolID					= $('.form .form-addgroup input[type=hidden]#addgroup-schoolID').val(),
			addgroup_name						= $('.form .form-addgroup .form-row .row-field .ftext#addgroup-name').val(),
			addgroup_grade						= $('.form .form-addgroup .form-row .row-field .fselect#addgroup-grade').val(),
			addgroup_postdata					=	'group_schoolID=' + addgroup_schoolID +
													'&group_name=' + addgroup_name +
													'&group_grade=' + addgroup_grade;
	
	addgroup_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		addgroup_spiner.css({
			'height' : addgroup_submitButton.height(),
			'width' : addgroup_submitButton.width(),
			'padding-top' : addgroup_submitButton.css('padding-top') - 1,
			'padding-bottom' : addgroup_submitButton.css('padding-bottom'),
			'padding-left' : addgroup_submitButton.css('padding-left'),
			'padding-right' : addgroup_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			addgroup_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_groups&m=addgroup_attempt',
					data		: addgroup_postdata,
					success		: function (successaddgroupRequest) {
						addgroup_form_messenger.slideUp(showtimer, function () {
							addgroup_form_messenger.html(successaddgroupRequest).slideDown(showtimer);
						});
					},
					error		: function (erroraddgroupRequest, errorTxtaddgroupRequest, errorThrownaddgroupRequest) {
						addgroup_form_messenger.slideUp(showtimer, function () {
							addgroup_form_messenger.html('<span class="bar-error">' + erroraddgroupRequest.status + ' ' + errorThrownaddgroupRequest + '</span>').slideDown(showtimer);
							addgroup_spiner.fadeOut(0, function () {
								addgroup_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: addGroupAttepmt





/**
 * 
 * deleteGroupAttempt
 */
function deleteGroupAttempt (schoolID, schoolCCT, groupID, groupName, groupGrade) {
	
	if ( schoolID == undefined )
		schoolID = 0;
	
	if ( schoolCCT == undefined )
		schoolCCT = '';
	
	if ( groupID == undefined )
		groupID = 0;
	
	if ( groupName == undefined )
		groupName = 'A';
	
	if ( groupGrade == undefined )
		groupGrade = '0';
	
		var		tableRow			= $('.table.table-schools-groups .table-rows#schoolid_' + schoolID + '_schoolcct_' + schoolCCT + '_groupid_' + groupID + ''),
				tableRows			= $('.table.table-schools-groups .table-list .table-rows');
				oldColor			= tableRow.css('background-color'),
				bodyMessenger		= $('.body-messenger'),
				dashboardMessenger	= $('.dashboard-messenger');
		tableRow.css('background-color', '#ed1c24');
		if ( confirm ('¿Realmente desea eliminar el grupo "' + groupGrade + '° ' + groupName + '"?') ) {
			bodyMessenger.html('<span class="bar-message-alert">cargando&#133;</span>').fadeIn(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_groups&m=deletegroup_attempt',
					data		: 'groupID=' + groupID + '',
					success		: function (successContentLoaderRequest) {
						
						tableRow.slideUp(showtimer, function () {
							tableRow.remove();
							dashboardMessenger.slideUp(showtimer, function () {
								dashboardMessenger.html('<span class="bar-success" style="margin-top: 10px;">El grupo <b>"' + groupGrade + ' ' + groupName + ' "</b> ha sido eliminado.</span>').slideDown(showtimer, function () {
									if ( dashboardTimeOut != undefined )
										clearTimeout(dashboardTimeOut);
									
									var dashboardTimeOut = setTimeout(function () {
										dashboardMessenger.slideUp(showtimer);
									}, 10000);
									
									var rowcounter = 0;
									$('.table-rows').each(function () {
										var row = $(this);
										row.removeClass('odd');
										if ( rowcounter == 1 ) {
											row.addClass('odd');
											rowcounter = 0;
										}
										else if ( rowcounter == 0 )
											rowcounter = 1;
									});
								});
							});
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
							if ( (tableRows.length - 1) == 0 ) {
								$('.table.table-schools-groups .table-list').html('<span class="table-rows empty-row">Usted no ha registrado ningún grupo</span>');
							}
						});
						
					},
					error		: function (errorjqXHRContentLoaderRequest, errorTxtContentLoaderRequest, errorThrownContentLoaderRequest) {
						bodyMessenger.html('<span class="bar-message-error">#' + errorjqXHRContentLoaderRequest.status + ' ' + errorThrownContentLoaderRequest + '</span>');
						setTimeout(function () {
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
						}, 10000);
					}
				});
			});
		}
		else
			tableRow.css('background-color', oldColor);
}
// end: deleteGroupAttempt





/**
 * 
 * editGroupAttepmt
 * 
 * function to attempt to edit group info
 */
function editGroupAttepmt () {
	var		editgroup_submitButton				= $('.form .form-editgroup .form-actions .button.submit'),
			editgroup_form_messenger			= $('.form .form-editgroup .form-messenger'),
			editgroup_spiner					= $('.form .form-editgroup .form-actions .spinner-16x16'),
			editgroup_id						= $('.form .form-editgroup input[type=hidden]#editgroup-groupID').val(),
			editgroup_grade						= $('.form .form-editgroup .form-row .row-field .fselect#editgroup-grade').val(),
			editgroup_name						= $('.form .form-editgroup .form-row .row-field .ftext#editgroup-name').val(),
			editgroup_postdata					=	'groupID=' + editgroup_id +
													'&grade=' + editgroup_grade +
													'&name=' + editgroup_name;
	
	editgroup_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		editgroup_spiner.css({
			'height' : editgroup_submitButton.height(),
			'width' : editgroup_submitButton.width(),
			'padding-top' : editgroup_submitButton.css('padding-top') - 1,
			'padding-bottom' : editgroup_submitButton.css('padding-bottom'),
			'padding-left' : editgroup_submitButton.css('padding-left'),
			'padding-right' : editgroup_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			editgroup_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_groups&m=editgroup_attempt',
					data		: editgroup_postdata,
					success		: function (successeditgroupRequest) {
						editgroup_form_messenger.slideUp(showtimer, function () {
							editgroup_form_messenger.html(successeditgroupRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditgroupRequest, errorTxteditgroupRequest, errorThrowneditgroupRequest) {
						editgroup_form_messenger.slideUp(showtimer, function () {
							editgroup_form_messenger.html('<span class="bar-error">' + erroreditgroupRequest.status + ' ' + errorThrowneditgroupRequest + '</span>').slideDown(showtimer);
							editgroup_spiner.fadeOut(0, function () {
								editgroup_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: editGroupAttepmt





/**
 * 
 * addStudentAttepmt
 * 
 * function to attempt to add student to the database
 */
function addStudentAttepmt () {
	var		addstudent_submitButton				= $('.form .form-add-student .form-actions .button.submit'),
			addstudent_form_messenger			= $('.form .form-add-student .form-messenger'),
			addstudent_spiner					= $('.form .form-add-student .form-actions .spinner-16x16'),
			addstudent_schoolID					= $('.form .form-add-student input[type=hidden]#addstudent-schoolID').val(),
			addstudent_schoolCCT				= $('.form .form-add-student input[type=hidden]#addstudent-schoolCCT').val(),
			addstudent_groupID					= $('.form .form-add-student input[type=hidden]#addstudent-groupID').val(),
			addstudent_fname					= $('.form .form-add-student .form-row .row-field .ftext#addstudent-firstname').val(),
			addstudent_lname					= $('.form .form-add-student .form-row .row-field .ftext#addstudent-lastname').val(),
			addstudent_curp						= $('.form .form-add-student .form-row .row-field .ftext#addstudent-curp').val(),
			addstudent_sex						= $('.form .form-add-student .form-row .row-field .fselect#addstudent-sex').val(),
			addstudent_postdata					=	'schoolID='		+ addstudent_schoolID	+
													'&schoolCCT='	+ addstudent_schoolCCT	+
													'&groupID='		+ addstudent_groupID	+
													'&fname='		+ addstudent_fname		+
													'&lname='		+ addstudent_lname		+
													'&curp='		+ addstudent_curp		+
													'&sex='			+ addstudent_sex;
	
	addstudent_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		addstudent_spiner.css({
			'height' : addstudent_submitButton.height(),
			'width' : addstudent_submitButton.width(),
			'padding-top' : addstudent_submitButton.css('padding-top') - 1,
			'padding-bottom' : addstudent_submitButton.css('padding-bottom'),
			'padding-left' : addstudent_submitButton.css('padding-left'),
			'padding-right' : addstudent_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			addstudent_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_students&m=addstudent_attempt',
					data		: addstudent_postdata,
					success		: function (successaddstudentRequest) {
						addstudent_form_messenger.slideUp(showtimer, function () {
							addstudent_form_messenger.html(successaddstudentRequest).slideDown(showtimer);
						});
					},
					error		: function (erroraddstudentRequest, errorTxtaddstudentRequest, errorThrownaddstudentRequest) {
						addstudent_form_messenger.slideUp(showtimer, function () {
							addstudent_form_messenger.html('<span class="bar-error">' + erroraddstudentRequest.status + ' ' + errorThrownaddstudentRequest + '</span>').slideDown(showtimer);
							addstudent_spiner.fadeOut(0, function () {
								addstudent_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: addStudentAttempt





/**
 * 
 * deleteStudentAttempt
 * 
 * function to attempt to delete student
 * 
 * @param integer studentID
 * @param string studentName
 */
function deleteStudentAttempt (schoolID, schoolCCT, groupID, studentID, studentName) {
	if ( schoolID == undefined )
		schoolID = 0;
	
	if ( schoolCCT == undefined )
		schoolCCT = '';
	
	if ( groupID == undefined )
		groupID = 0;
	
	if ( studentID == undefined )
		studentID = 0;
	
	if ( studentName == undefined )
		studentName = 'Undefined Name';
	
		var		tableRow			= $('.table.table-schools-groups-students .table-rows#schoolid_' + schoolID + '_schoolcct_' + schoolCCT + '_groupid_' + groupID + '_studentid_' + studentID + ''),
				tableRows			= $('.table.table-schools-groups-students .table-list .table-rows');
				oldColor			= tableRow.css('background-color'),
				bodyMessenger		= $('.body-messenger'),
				dashboardMessenger	= $('.dashboard-messenger');
		tableRow.css('background-color', '#ed1c24');
		if ( confirm ('¿Realmente desea eliminar al alumno "' + studentName + '"?') ) {
			bodyMessenger.html('<span class="bar-message-alert">cargando&#133;</span>').fadeIn(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_students&m=deletestudent_attempt',
					data		: 'studentID=' + studentID + '',
					success		: function (successContentLoaderRequest) {
						
						tableRow.slideUp(showtimer, function () {
							tableRow.remove();
							dashboardMessenger.slideUp(showtimer, function () {
								dashboardMessenger.html('<span class="bar-success" style="margin-top: 10px;">El alumno <b>"' + studentName + ' "</b> se ha dado de baja.</span>').slideDown(showtimer, function () {
									if ( dashboardTimeOut != undefined )
										clearTimeout(dashboardTimeOut);
									
									var dashboardTimeOut = setTimeout(function () {
										dashboardMessenger.slideUp(showtimer);
									}, 10000);
									
									var rowcounter = 0;
									$('.table-rows').each(function () {
										var row = $(this);
										row.removeClass('odd');
										if ( rowcounter == 1 ) {
											row.addClass('odd');
											rowcounter = 0;
										}
										else if ( rowcounter == 0 )
											rowcounter = 1;
									});
								});
							});
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
							if ( (tableRows.length - 1) == 0 ) {
								$('.table.table-schools-groups-students .table-list').html('<span class="table-rows empty-row">Usted no ha registrado ningún alumno</span>');
							}
						});
						
					},
					error		: function (errorjqXHRContentLoaderRequest, errorTxtContentLoaderRequest, errorThrownContentLoaderRequest) {
						bodyMessenger.html('<span class="bar-message-error">#' + errorjqXHRContentLoaderRequest.status + ' ' + errorThrownContentLoaderRequest + '</span>');
						setTimeout(function () {
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
						}, 10000);
					}
				});
			});
		}
		else
			tableRow.css('background-color', oldColor);
}
// end: deleteStudentAttempt





/**
 * 
 * editStudentAttepmt
 */
function editStudentAttepmt () {
	
	var		editstudent_submitButton			= $('.form .form-edit-student .form-actions .button.submit'),
			editstudent_form_messenger			= $('.form .form-edit-student .form-messenger'),
			editstudent_spiner					= $('.form .form-edit-student .form-actions .spinner-16x16'),
			editstudent_id						= $('.form .form-edit-student input[type=hidden]#editstudent-studentID').val(),
			editstudent_schoolID				= $('.form .form-edit-student input[type=hidden]#editstudent-schoolID').val(),
			editstudent_schoolCCT				= $('.form .form-edit-student input[type=hidden]#editstudent-schoolCCT').val(),
			editstudent_groupID					= $('.form .form-edit-student input[type=hidden]#editstudent-groupID').val(),
			editstudent_fname					= $('.form .form-edit-student .form-row .row-field .ftext#editstudent-firstname').val(),
			editstudent_lname					= $('.form .form-edit-student .form-row .row-field .ftext#editstudent-lastname').val(),
			editstudent_curp					= $('.form .form-edit-student .form-row .row-field .ftext#editstudent-curp').val(),
			editstudent_sex						= $('.form .form-edit-student .form-row .row-field .fselect#editstudent-sex').val(),
			editstudent_postdata				=	'studentID='	+ editstudent_id			+
													'&schoolID='	+ editstudent_schoolID		+
													'&schoolCCT='	+ editstudent_schoolCCT		+
													'&groupID='		+ editstudent_groupID		+
													'&fname='		+ editstudent_fname			+
													'&lname='		+ editstudent_lname			+
													'&curp='		+ editstudent_curp			+
													'&sex='			+ editstudent_sex;
	
	editstudent_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		editstudent_spiner.css({
			'height' : editstudent_submitButton.height(),
			'width' : editstudent_submitButton.width(),
			'padding-top' : editstudent_submitButton.css('padding-top') - 1,
			'padding-bottom' : editstudent_submitButton.css('padding-bottom'),
			'padding-left' : editstudent_submitButton.css('padding-left'),
			'padding-right' : editstudent_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			editstudent_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_students&m=editstudent_attempt',
					data		: editstudent_postdata,
					success		: function (successeditstudentRequest) {
						editstudent_form_messenger.slideUp(showtimer, function () {
							editstudent_form_messenger.html(successeditstudentRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditstudentRequest, errorTxteditstudentRequest, errorThrowneditstudentRequest) {
						editstudent_form_messenger.slideUp(showtimer, function () {
							editstudent_form_messenger.html('<span class="bar-error">' + erroreditstudentRequest.status + ' ' + errorThrowneditstudentRequest + '</span>').slideDown(showtimer);
							editstudent_spiner.fadeOut(0, function () {
								editstudent_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: editStudents





/**
 * 
 * saveStudentAnswers
 * 
 * function to save answers to the database 
 */
function saveStudentAnswers () {
	
	var unanswered			= new Array(),
			answered			= new Array(),
			answeredQuestions	= '',
			unansweredCounter	= 0,
			answeredCounter		= 0,
			cicleCounter		= 0,
			unansweredMessage	= '',
			questionCounter		= 0,
			studentID			= $('input#studentID').val(),
			schoolID			= $('input#schoolID').val(),
			schoolCCT			= $('input#schoolCCT').val(),
			groupID				= $('input#groupID').val(),
			postValues			= 'studentID=' + studentID + '&schoolID=' + schoolID + '&schoolCCT=' + schoolCCT + '&groupID=' + groupID + '';
		$('.table .table-rows.question-item').each(function () {
			var		question		= $(this),
					questionID		= (question.attr('id')).split('_')[1],
					questionNumber	= (question.attr('id')).split('_')[3],
					answers			= question.find('input[@type=radio]:checked');
			if ( answers.val() != undefined ) {
				answered[answeredCounter] = questionNumber;
				answeredCounter++;
				answeredQuestions += '&answernumber_' + questionNumber + '=' + answers.val();
			}
			else{
				unanswered[unansweredCounter] = questionNumber;
				unansweredCounter++;
				questionCounter = 0;
				answeredQuestions = '';
			}
			questionCounter++;
		});
		
		if ( unanswered.length == 0 ) {
			$('.app-messenger').slideUp(showtimer, function () {
				
				// $(this).html('<span class="box-success">' + postValues + answeredQuestions + '</span>').slideDown(showtimer);
				var finishQuestions = $('.dashboard-container .action-button.end-questions');
				$('.dashboard-container .action-button.end-questions').fadeOut(0, function () {
					$('.button-end-questions-area').prepend('<span class="spinner-16x16"></span>');
					$('.button-end-questions-area .spiner-16x16').css({
						'height' : finishQuestions.height(),
						'width' : finishQuestions.width(),
						'border' : '1px solid transparent',
						'padding-top' : finishQuestions.css('padding-top'),
						'padding-bottom' : finishQuestions.css('padding-bottom'),
						'padding-left' : finishQuestions.css('padding-left'),
						'padding-right' : finishQuestions.css('padding-right')
					}).fadeIn(0);
					$.ajax({
						type		: 'POST',
						url			: __BASEPATH + '?c=secundaria_app&m=app_student_attempt',
						data		: postValues + answeredQuestions,
						success		: function (successSaveAnswersRequest) {
							$('.app-messenger').html(successSaveAnswersRequest).slideDown(showtimer);
						},
						error		: function (errorjqXHRSaveAnswersRequest, txterrorSaveAnswersRequest, errorThrownSaveAnswersRequest) {
							$('.app-messenger').html('<span class="bar-error">' + errorjqXHRSaveAnswersRequest.status + ' ' + errorThrownSaveAnswersRequest + '</span>').slideDown(showtimer);
						}
					});
				});
			});
		}
		else if ( unanswered.length > 0 ) {
			for ( cicleCounter = 0 ; cicleCounter < unanswered.length ; cicleCounter++ ) {
				unansweredMessage += 'debes contestar también la <b>pregunta ' + unanswered[cicleCounter] + '</b><br />';
			}
			$('.app-messenger').slideUp(showtimer, function () {
				$(this).html('<span class="box-info">' + unansweredMessage + '</span>').slideDown(showtimer);
			});
		}
}
// end: saveStudentAnswers





/**
 * 
 * unlockSystemAttempt
 * 
 * function to try to unlock the system
 */
function unlockSystemAttempt () {
	var		unlocksystem_submitButton			= $('.form .form-unlock-system .form-actions .button.submit.unlock'),
			unlocksystem_form_messenger			= $('.form .form-unlock-system .form-messenger'),
			unlocksystem_spiner					= $('.form .form-unlock-system .form-actions .spinner-16x16'),
			unlocksystem_schoolID				= $('.form .form-unlock-system input[type=hidden]#unlocksystem-schoolID').val(),
			unlocksystem_schoolCCT				= $('.form .form-unlock-system input[type=hidden]#unlocksystem-schoolCCT').val(),
			unlocksystem_groupID				= $('.form .form-unlock-system input[type=hidden]#unlocksystem-groupID').val(),
			unlocksystem_password				= $('.form .form-unlock-system .form-row .row-field .ftext#unlocksystem-password').val(),
			unlocksystem_postdata				=	'&schoolID='	+ unlocksystem_schoolID		+
													'&schoolCCT='	+ unlocksystem_schoolCCT	+
													'&groupID='		+ unlocksystem_groupID		+
													'&password='	+ unlocksystem_password;
	
	unlocksystem_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		unlocksystem_spiner.css({
			'height' : unlocksystem_submitButton.height(),
			'width' : unlocksystem_submitButton.width(),
			'padding-top' : unlocksystem_submitButton.css('padding-top') - 1,
			'padding-bottom' : unlocksystem_submitButton.css('padding-bottom'),
			'padding-left' : unlocksystem_submitButton.css('padding-left'),
			'padding-right' : unlocksystem_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			unlocksystem_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_app&m=unlocksystem_attempt',
					data		: unlocksystem_postdata,
					success		: function (successeditstudentRequest) {
						unlocksystem_form_messenger.slideUp(showtimer, function () {
							unlocksystem_form_messenger.html(successeditstudentRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditstudentRequest, errorTxteditstudentRequest, errorThrowneditstudentRequest) {
						unlocksystem_form_messenger.slideUp(showtimer, function () {
							unlocksystem_form_messenger.html('<span class="bar-error">' + erroreditstudentRequest.status + ' ' + errorThrowneditstudentRequest + '</span>').slideDown(showtimer);
							unlocksystem_spiner.fadeOut(0, function () {
								unlocksystem_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}





/**
 * 
 * showMySchools
 * 
 * function to show my schools
 */

function showMySchools () {
	var		unlocksystem_submitButton			= $('.form .form-unlock-system .form-actions .button.submit.continue'),
			unlocksystem_form_messenger			= $('.form .form-unlock-system .form-messenger'),
			unlocksystem_spiner					= $('.form .form-unlock-system .form-actions .spinner-16x16'),
			unlocksystem_schoolID				= $('.form .form-unlock-system input[type=hidden]#unlocksystem-schoolID').val(),
			unlocksystem_schoolCCT				= $('.form .form-unlock-system input[type=hidden]#unlocksystem-schoolCCT').val(),
			unlocksystem_groupID				= $('.form .form-unlock-system input[type=hidden]#unlocksystem-groupID').val(),
			unlocksystem_password				= $('.form .form-unlock-system .form-row .row-field .ftext#unlocksystem-password').val(),
			unlocksystem_postdata				=	'&schoolID='	+ unlocksystem_schoolID		+
													'&schoolCCT='	+ unlocksystem_schoolCCT	+
													'&groupID='		+ unlocksystem_groupID		+
													'&password='	+ unlocksystem_password;
	
	unlocksystem_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		unlocksystem_spiner.css({
			'height' : unlocksystem_submitButton.height(),
			'width' : unlocksystem_submitButton.width(),
			'padding-top' : unlocksystem_submitButton.css('padding-top') - 1,
			'padding-bottom' : unlocksystem_submitButton.css('padding-bottom'),
			'padding-left' : unlocksystem_submitButton.css('padding-left'),
			'padding-right' : unlocksystem_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			unlocksystem_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_app&m=showschools_attempt',
					data		: unlocksystem_postdata,
					success		: function (successeditstudentRequest) {
						unlocksystem_form_messenger.slideUp(showtimer, function () {
							unlocksystem_form_messenger.html(successeditstudentRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditstudentRequest, errorTxteditstudentRequest, errorThrowneditstudentRequest) {
						unlocksystem_form_messenger.slideUp(showtimer, function () {
							unlocksystem_form_messenger.html('<span class="bar-error">' + erroreditstudentRequest.status + ' ' + errorThrowneditstudentRequest + '</span>').slideDown(showtimer);
							unlocksystem_spiner.fadeOut(0, function () {
								unlocksystem_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: showMySchool





/**
 * 
 * addSchoolRelationship
 * 
 * function to add relationshio between user and school
 */
function addSchoolRelationship () {
	var		addschoolrelationship_submitButton			= $('.form .form-add-user-school .form-actions .button.submit'),
			addschoolrelationship_form_messenger		= $('.form .form-add-user-school .form-messenger'),
			addschoolrelationship_spiner				= $('.form .form-add-user-school .form-actions .spinner-16x16'),
			addschoolrelationship_cct					= $('.form .form-add-user-school .form-row .row-field .ftext#addschool-cct').val(),
			addschoolrelationship_postdata				= 'cct=' + addschoolrelationship_cct + '';
	addschoolrelationship_form_messenger.slideUp(showtimer, function () {
		
		lockFormFields();
		addschoolrelationship_spiner.css({
			'height' : addschoolrelationship_submitButton.height(),
			'width' : addschoolrelationship_submitButton.width(),
			'padding-top' : addschoolrelationship_submitButton.css('padding-top') - 1,
			'padding-bottom' : addschoolrelationship_submitButton.css('padding-bottom'),
			'padding-left' : addschoolrelationship_submitButton.css('padding-left'),
			'padding-right' : addschoolrelationship_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			addschoolrelationship_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_user&m=window_addme_to_school_attempt',
					data		: addschoolrelationship_postdata,
					success		: function (successeditstudentRequest) {
						addschoolrelationship_form_messenger.slideUp(showtimer, function () {
							addschoolrelationship_form_messenger.html(successeditstudentRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditstudentRequest, errorTxteditstudentRequest, errorThrowneditstudentRequest) {
						addschoolrelationship_form_messenger.slideUp(showtimer, function () {
							addschoolrelationship_form_messenger.html('<span class="bar-error">' + erroreditstudentRequest.status + ' ' + errorThrowneditstudentRequest + '</span>').slideDown(showtimer);
							addschoolrelationship_spiner.fadeOut(0, function () {
								addschoolrelationship_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: addSchoolRelationship





/**
 * 
 * removeSchool
 * 
 * function to send the request of delete school
 * 
 * @param integer school_id
 */
function removeSchool (school_id) {
	
	if ( school_id != undefined ) {
		
		$.ajax({
			type		: 'POST',
			url			: __BASEPATH + '?c=secundaria_root_schools&m=school_delete&school_id=' + school_id + '',
			data		: 'school_id=' + school_id + '',
			success		: function (successRemoveSchoolData) {
				$('.dashboard-messenger').slideUp(showtimer, function () {
					$(this).html(successRemoveSchoolData).slideDown(showtimer);
				});
			},
			error		: function (jqXHR, textStatus, errorThrown) {
				$('.dashboard-messenger').slideUp(showtimer, function () {
					$(this).html('<span class="bar-error">error ' + jqXHR.status + ' : ' + errorThrown + '</span>').slideDown(showtimer);
				});				
			}
		});
	}
}
// end: removeSchool





/**
 * 
 * deleteQuestion
 * 
 * function to delete a question
 * 
 * @param integer question_id
 */
function deleteQuestion (question_id) {
	if ( question_id != undefined ) {
		$.ajax({
			type		: 'POST',
			url			: __BASEPATH + '?c=secundaria_qa&m=question_delete&question_id=' + question_id + '',
			data		: 'question_id=' + question_id + '',
			success		: function (successRemoveQuestionData) {
				$('.dashboard-messenger').slideUp(showtimer, function () {
					$(this).html(successRemoveQuestionData).slideDown(showtimer, function () {
						var rowcounter = 0;
						$('.table-rows').each(function () {
							var row = $(this);
							row.removeClass('odd');
							if ( rowcounter == 1 ) {
								row.addClass('odd');
								rowcounter = 0;
							}
							else if ( rowcounter == 0 )
								rowcounter = 1;
						});
					});
				});
				
			},
			error		: function (jqXHR, textStatus, errorThrown) {
				$('.dashboard-messenger').slideUp(showtimer, function () {
					$(this).html('<span class="bar-error">error ' + jqXHR.status + ' : ' + errorThrown + '</span>').slideDown(showtimer);
				});
			}
		});
	}
}
// end: deleteQuestion





/**
 * 
 * editQuestionAttempt_root
 * 
 * function to attempt to save question updates
 */
function editQuestionAttempt_root () {
	var		editquestion_submitButton			= $('.form .form-editquestion-root .form-actions .button.submit'),
			editquestion_form_messenger			= $('.form .form-editquestion-root .form-messenger'),
			editquestion_spiner					= $('.form .form-editquestion-root .form-actions .spinner-16x16'),
			editquestion_id						= $('.form .form-editquestion-root input[type=hidden]#editquestion-question-id').val(),
			editquestion_content				= $('.form .form-editquestion-root .form-row .row-field .ftext#editquestion-question-content').val(),
			editquestion_postdata				= 'question_id=' + editquestion_id + '&question_content=' + editquestion_content + '';
	editquestion_form_messenger.slideUp(showtimer, function () {
		
		lockFormFields();
		editquestion_spiner.css({
			'height' : editquestion_submitButton.height(),
			'width' : editquestion_submitButton.width(),
			'padding-top' : editquestion_submitButton.css('padding-top') - 1,
			'padding-bottom' : editquestion_submitButton.css('padding-bottom'),
			'padding-left' : editquestion_submitButton.css('padding-left'),
			'padding-right' : editquestion_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			editquestion_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=window_edit_question_attempt',
					data		: editquestion_postdata,
					success		: function (successeditstudentRequest) {
						editquestion_form_messenger.slideUp(showtimer, function () {
							editquestion_form_messenger.html(successeditstudentRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditstudentRequest, errorTxteditstudentRequest, errorThrowneditstudentRequest) {
						editquestion_form_messenger.slideUp(showtimer, function () {
							editquestion_form_messenger.html('<span class="bar-error">' + erroreditstudentRequest.status + ' ' + errorThrowneditstudentRequest + '</span>').slideDown(showtimer);
							editquestion_spiner.fadeOut(0, function () {
								editquestion_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: editQuestionAttempt_root





/**
 *
 * addSchoolAttepmt_root
 * 
 * function to attempt to add new school
 */

function addSchoolAttepmt_root () {
	var		addschool_submitButton			= $('.form .form-addschool-root .form-actions .button.submit'),
			addschool_form_messenger		= $('.form .form-addschool-root .form-messenger'),
			addschool_spiner				= $('.form .form-addschool-root .form-actions .spinner-16x16'),
			addschool_cct					= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-cct').val(),
			addschool_name					= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-name').val(),
			addschool_address				= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-address').val(),
			addschool_colony				= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-colony').val(),
			addschool_delegation			= $('.form .form-addschool-root .form-row .row-field .fselect#addschool-delegation').val(),
			addschool_zipcode				= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-zipcode').val(),
			addschool_phone					= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-phone').val(),
			addschool_supervisionzone		= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-supervisionzone').val(),
			addschool_usaer					= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-usaer').val(),
			addschool_usaer_supervisionzone	= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-usaer-supervisionzone').val(),
			addschool_turn					= $('.form .form-addschool-root .form-row .row-field .fselect#addschool-turn').val(),
			addschool_grade_one				= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-grade-one').val(),
			addschool_grade_two				= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-grade-two').val(),
			addschool_grade_three			= $('.form .form-addschool-root .form-row .row-field .ftext#addschool-grade-three').val(),
			addschool_postdata				=	'cct=' + addschool_cct +
												'&name=' + addschool_name +
												'&address=' + addschool_address +
												'&colony=' + addschool_colony +
												'&delegation=' + addschool_delegation +
												'&zipcode=' + addschool_zipcode +
												'&phone=' + addschool_phone +
												'&supervisionzone=' + addschool_supervisionzone +
												'&usaer=' + addschool_usaer +
												'&usaer_supervisionzone=' + addschool_usaer_supervisionzone +
												'&turn=' + addschool_turn +
												'&grade_one=' + addschool_grade_one +
												'&grade_two=' + addschool_grade_two +
												'&grade_three=' + addschool_grade_three + '';
	
	addschool_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		addschool_spiner.css({
			'height' : addschool_submitButton.height(),
			'width' : addschool_submitButton.width(),
			'padding-top' : addschool_submitButton.css('padding-top') - 1,
			'padding-bottom' : addschool_submitButton.css('padding-bottom'),
			'padding-left' : addschool_submitButton.css('padding-left'),
			'padding-right' : addschool_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			addschool_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=addschool_attempt',
					data		: addschool_postdata,
					success		: function (successAddSchoolRequest) {
						addschool_form_messenger.slideUp(showtimer, function () {
							addschool_form_messenger.html(successAddSchoolRequest).slideDown(showtimer);
						});
					},
					error		: function (errorAddSchoolRequest, errorTxtAddSchoolRequest, errorThrownAddSchoolRequest) {
						addschool_form_messenger.slideUp(showtimer, function () {
							addschool_form_messenger.html('<span class="bar-error">' + errorAddSchoolRequest.status + ' ' + errorThrownAddSchoolRequest + '</span>').slideDown(showtimer);
							addschool_spiner.fadeOut(0, function () {
								addschool_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: addSchoolAttepmt_root





/**
 * 
 * upgrade_all_school_grade_students
 */
function upgrade_all_school_grade_students () {
	var				upgrade_submitButton			= $('.form .form-upgrade-schools-students .form-actions .button.submit'),
					upgrade_form_messenger			= $('.form .form-upgrade-schools-students .form-messenger'),
					upgrade_spiner					= $('.form .form-upgrade-schools-students .form-actions .spinner-16x16'),
					upgrade_from					= $('.form .form-upgrade-schools-students .form-row .row-field .fselect#grade-from').val(),
					upgrade_to						= $('.form .form-upgrade-schools-students .form-row .row-field .fselect#grade-to').val(),
					upgrade_postdata				=	'upgrade_from='		+ upgrade_from		+ '&' +
														'upgrade_to='		+ upgrade_to;
	if ( upgrade_from != upgrade_to ) {
		upgrade_form_messenger.slideUp(showtimer, function () {
			lockFormFields();
			upgrade_spiner.css({
				'height' : upgrade_submitButton.height(),
				'width' : upgrade_submitButton.width(),
				'padding-top' : upgrade_submitButton.css('padding-top') - 1,
				'padding-bottom' : upgrade_submitButton.css('padding-bottom'),
				'padding-left' : upgrade_submitButton.css('padding-left'),
				'padding-right' : upgrade_submitButton.css('padding-right'),
				'border' : '1px solid transparent',
				'display' : 'inline-block'
			}).fadeIn(0, function () {
				upgrade_submitButton.fadeOut(0, function () {
					$.ajax({
						type		: 'POST',
						url			: __BASEPATH + '?c=secundaria_profile_root&m=upgrade_schools_students_attempt',
						data		: upgrade_postdata,
						success		: function (successupgradeRequest) {
							upgrade_form_messenger.slideUp(showtimer, function () {
								upgrade_form_messenger.html(successupgradeRequest).slideDown(showtimer);
							});
						},
						error		: function (errorupgradeRequest, errorTxtupgradeRequest, errorThrownupgradeRequest) {
							upgrade_form_messenger.slideUp(showtimer, function () {
								upgrade_form_messenger.html('<span class="bar-error">' + errorupgradeRequest.status + ' ' + errorThrownupgradeRequest + '</span>').slideDown(showtimer);
								upgrade_spiner.fadeOut(0, function () {
									upgrade_submitButton.fadeIn(0);
									unlockFormFields();
								});
							});
						}
					});
				});
			});
		});
	}
	else
		alert('Debe seleccionar diferentes grados para que se pueda llevar a cabo esta acción');
}
// end: upgrade_all_school_grade_students





/**
 * 
 * upgrade_students_by_group_root
 */
function upgrade_students_by_group_root () {
	
	var				upgrade_submitButton			= $('.form .form-upgrade-schools-students-by-group .form-actions .button.submit'),
					upgrade_form_messenger			= $('.form .form-upgrade-schools-students-by-group .form-messenger'),
					upgrade_spiner					= $('.form .form-upgrade-schools-students-by-group .form-actions .spinner-16x16'),
					schoolid						= $('.form .form-upgrade-schools-students-by-group input[type=hidden]#grade_group_schoolid').val(),
					schoolcct						= $('.form .form-upgrade-schools-students-by-group input[type=hidden]#grade_group_schoolcct').val(),
					groupid							= $('.form .form-upgrade-schools-students-by-group input[type=hidden]#grade_group_groupid').val(),
					grade							= $('.form .form-upgrade-schools-students-by-group input[type=hidden]#grade_group_grade').val(),
					groupid_from					= $('.form .form-upgrade-schools-students-by-group .form-row .row-field .fselect#grade_group_from').val(),
					groupid_to						= $('.form .form-upgrade-schools-students-by-group .form-row .row-field .fselect#grade_group_to').val(),
					upgrade_postdata				=	'schoolid='			+ schoolid			+ '&' +
														'schoolcct='		+ schoolcct			+ '&' +
														'groupid='			+ groupid			+ '&' +
														'grade='			+ grade				+ '&' +
														'groupid_from='		+ groupid_from		+ '&' +
														'groupid_to='		+ groupid_to;
	
	
	upgrade_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		upgrade_spiner.css({
			'height' : upgrade_submitButton.height(),
			'width' : upgrade_submitButton.width(),
			'padding-top' : upgrade_submitButton.css('padding-top') - 1,
			'padding-bottom' : upgrade_submitButton.css('padding-bottom'),
			'padding-left' : upgrade_submitButton.css('padding-left'),
			'padding-right' : upgrade_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			upgrade_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=upgrade_schools_groups_students_attempt',
					data		: upgrade_postdata,
					success		: function (successupgradeRequest) {
						upgrade_form_messenger.slideUp(showtimer, function () {
							upgrade_form_messenger.html(successupgradeRequest).slideDown(showtimer);
						});
					},
					error		: function (errorupgradeRequest, errorTxtupgradeRequest, errorThrownupgradeRequest) {
						upgrade_form_messenger.slideUp(showtimer, function () {
							upgrade_form_messenger.html('<span class="bar-error">' + errorupgradeRequest.status + ' ' + errorThrownupgradeRequest + '</span>').slideDown(showtimer);
							upgrade_spiner.fadeOut(0, function () {
								upgrade_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: upgrade_students_by_group_root





/**
 * 
 * editStudentAttepmt_root
 */
function editStudentAttepmt_root () {
	
	var		editstudent_submitButton			= $('.form .form-edit-student-root .form-actions .button.submit'),
			editstudent_form_messenger			= $('.form .form-edit-student-root .form-messenger'),
			editstudent_spiner					= $('.form .form-edit-student-root .form-actions .spinner-16x16'),
			editstudent_id						= $('.form .form-edit-student-root input[type=hidden]#editstudent-studentID').val(),
			editstudent_schoolID				= $('.form .form-edit-student-root input[type=hidden]#editstudent-schoolID').val(),
			editstudent_schoolCCT				= $('.form .form-edit-student-root input[type=hidden]#editstudent-schoolCCT').val(),
			editstudent_groupID					= $('.form .form-edit-student-root input[type=hidden]#editstudent-groupID').val(),
			editstudent_fname					= $('.form .form-edit-student-root .form-row .row-field .ftext#editstudent-firstname').val(),
			editstudent_lname					= $('.form .form-edit-student-root .form-row .row-field .ftext#editstudent-lastname').val(),
			editstudent_curp					= $('.form .form-edit-student-root .form-row .row-field .ftext#editstudent-curp').val(),
			editstudent_sex						= $('.form .form-edit-student-root .form-row .row-field .fselect#editstudent-sex').val(),
			new_school_id						= $('.form .form-edit-student-root .form-row .row-field .fselect#editstudent-school').val(),
			new_group_id						= $('.form .form-edit-student-root .form-row .row-field .fselect#editstudent-grade-group').val(),
			editstudent_postdata				=	'studentID='	+ editstudent_id			+
													'&schoolID='	+ editstudent_schoolID		+
													'&schoolCCT='	+ editstudent_schoolCCT		+
													'&groupID='		+ editstudent_groupID		+
													'&fname='		+ editstudent_fname			+
													'&lname='		+ editstudent_lname			+
													'&curp='		+ editstudent_curp			+
													'&sex='			+ editstudent_sex			+
													'&new_school='	+ new_school_id				+
													'&new_group='	+ new_group_id				;
	
	editstudent_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		editstudent_spiner.css({
			'height' : editstudent_submitButton.height(),
			'width' : editstudent_submitButton.width(),
			'padding-top' : editstudent_submitButton.css('padding-top') - 1,
			'padding-bottom' : editstudent_submitButton.css('padding-bottom'),
			'padding-left' : editstudent_submitButton.css('padding-left'),
			'padding-right' : editstudent_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			editstudent_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=editstudent_attempt',
					data		: editstudent_postdata,
					success		: function (successeditstudentRequest) {
						editstudent_form_messenger.slideUp(showtimer, function () {
							editstudent_form_messenger.html(successeditstudentRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditstudentRequest, errorTxteditstudentRequest, errorThrowneditstudentRequest) {
						editstudent_form_messenger.slideUp(showtimer, function () {
							editstudent_form_messenger.html('<span class="bar-error">' + erroreditstudentRequest.status + ' ' + errorThrowneditstudentRequest + '</span>').slideDown(showtimer);
							editstudent_spiner.fadeOut(0, function () {
								editstudent_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: editStudents_root





/**
 * 
 * edit_student_get_school_groups
 */
function edit_student_get_school_groups () {
	$('#editstudent-school').change(function () {
		var schoolid = $(this).val();
		$('#editstudent-grade-group').hide(0, function () {
			$(this).after('<span class="loading-content">cargando grupos&#133;</span>');
			$.ajax({
				type		: 'POST',
				url			: __BASEPATH + '?c=secundaria_profile_root&m=edit_student_get_school_groups',
				data		: 'schoolid=' + schoolid + '',
				success		: function (successRequest) {
					$('#editstudent-grade-group').html(successRequest).show(0);
					$('.loading-content').remove();
				},
				error		: function (errorRequest, errorRequestText, errorRequestThrown) {
					$('#editstudent-grade-group').after('<span class="bar-error">Error ' + errorRequest.status + ' ' + errorRequestThrown + '</span>');
					$('#editstudent-grade-group').hide(0);
				}
			});
		});
	});
}
// end: edit_student_get_school_groups





/**
 * 
 * upgradegroups_root
 */
function upgradegroups_root () {
	
	var		upgrade_group_submitButton			= $('.form .form-upgrade-schools-groups .form-actions .button.submit'),
			upgrade_group_form_messenger		= $('.form .form-upgrade-schools-groups .form-messenger'),
			upgrade_group_spiner				= $('.form .form-upgrade-schools-groups .form-actions .spinner-16x16'),
			upgrade_group_schoolid				= $('.form .form-upgrade-schools-groups input[type=hidden]#upgrade_schoolid').val(),
			upgrade_group_from					= $('.form .form-upgrade-schools-groups .form-row .row-field .fselect#upgrade_group_from').val(),
			upgrade_group_to					= $('.form .form-upgrade-schools-groups .form-row .row-field .fselect#upgrade_group_to').val(),
			upgrade_group_postdata				=	'schoolid='			+ upgrade_group_schoolid		+	'&'	+
													'group_from='		+ upgrade_group_from			+	'&'	+
													'group_to='			+ upgrade_group_to						;
	if ( upgrade_group_from != upgrade_group_to ) {
		upgrade_group_form_messenger.slideUp(showtimer, function () {
			lockFormFields();
			upgrade_group_spiner.css({
				'height' : upgrade_group_submitButton.height(),
				'width' : upgrade_group_submitButton.width(),
				'padding-top' : upgrade_group_submitButton.css('padding-top') - 1,
				'padding-bottom' : upgrade_group_submitButton.css('padding-bottom'),
				'padding-left' : upgrade_group_submitButton.css('padding-left'),
				'padding-right' : upgrade_group_submitButton.css('padding-right'),
				'border' : '1px solid transparent',
				'display' : 'inline-block'
			}).fadeIn(0, function () {
				upgrade_group_submitButton.fadeOut(0, function () {
					$.ajax({
						type		: 'POST',
						url			: __BASEPATH + '?c=secundaria_profile_root&m=upgrade_schools_groups_attempt',
						data		: upgrade_group_postdata,
						success		: function (successupgrade_groupRequest) {
							upgrade_group_form_messenger.slideUp(showtimer, function () {
								upgrade_group_form_messenger.html(successupgrade_groupRequest).slideDown(showtimer);
							});
						},
						error		: function (errorupgrade_groupRequest, errorTxtupgrade_groupRequest, errorThrownupgrade_groupRequest) {
							upgrade_group_form_messenger.slideUp(showtimer, function () {
								upgrade_group_form_messenger.html('<span class="bar-error">' + errorupgrade_groupRequest.status + ' ' + errorThrownupgrade_groupRequest + '</span>').slideDown(showtimer);
								upgrade_group_spiner.fadeOut(0, function () {
									upgrade_group_submitButton.fadeIn(0);
									unlockFormFields();
								});
							});
						}
					});
				});
			});
		});
	}
	else
		alert('Debe seleccionar diferentes grados/grupos para que se pueda llevar a cabo esta acción');
}
// end: upgradegroups_root





/**
 * 
 * addStudentAttempt_root
 * 
 * function to attempt to add student to the database
 */
function addStudentAttempt_root () {
	var		addstudent_submitButton				= $('.form .form-add-student-root .form-actions .button.submit'),
			addstudent_form_messenger			= $('.form .form-add-student-root .form-messenger'),
			addstudent_spiner					= $('.form .form-add-student-root .form-actions .spinner-16x16'),
			addstudent_schoolID					= $('.form .form-add-student-root input[type=hidden]#addstudent-schoolID').val(),
			addstudent_schoolCCT				= $('.form .form-add-student-root input[type=hidden]#addstudent-schoolCCT').val(),
			addstudent_groupID					= $('.form .form-add-student-root input[type=hidden]#addstudent-groupID').val(),
			addstudent_fname					= $('.form .form-add-student-root .form-row .row-field .ftext#addstudent-firstname').val(),
			addstudent_lname					= $('.form .form-add-student-root .form-row .row-field .ftext#addstudent-lastname').val(),
			addstudent_curp						= $('.form .form-add-student-root .form-row .row-field .ftext#addstudent-curp').val(),
			addstudent_sex						= $('.form .form-add-student-root .form-row .row-field .fselect#addstudent-sex').val(),
			addstudent_postdata					=	'schoolID='		+ addstudent_schoolID	+
													'&schoolCCT='	+ addstudent_schoolCCT	+
													'&groupID='		+ addstudent_groupID	+
													'&fname='		+ addstudent_fname		+
													'&lname='		+ addstudent_lname		+
													'&curp='		+ addstudent_curp		+
													'&sex='			+ addstudent_sex;
	
	addstudent_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		addstudent_spiner.css({
			'height' : addstudent_submitButton.height(),
			'width' : addstudent_submitButton.width(),
			'padding-top' : addstudent_submitButton.css('padding-top') - 1,
			'padding-bottom' : addstudent_submitButton.css('padding-bottom'),
			'padding-left' : addstudent_submitButton.css('padding-left'),
			'padding-right' : addstudent_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			addstudent_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=addstudent_attempt',
					data		: addstudent_postdata,
					success		: function (successaddstudentRequest) {
						addstudent_form_messenger.slideUp(showtimer, function () {
							addstudent_form_messenger.html(successaddstudentRequest).slideDown(showtimer);
						});
					},
					error		: function (erroraddstudentRequest, errorTxtaddstudentRequest, errorThrownaddstudentRequest) {
						addstudent_form_messenger.slideUp(showtimer, function () {
							addstudent_form_messenger.html('<span class="bar-error">' + erroraddstudentRequest.status + ' ' + errorThrownaddstudentRequest + '</span>').slideDown(showtimer);
							addstudent_spiner.fadeOut(0, function () {
								addstudent_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: addStudentAttempt_root






/**
 * 
 * deleteStudentAttempt_root
 * 
 * function to attempt to delete student
 * 
 * @param integer studentID
 * @param string studentName
 */
function deleteStudentAttempt_root (schoolID, schoolCCT, groupID, studentID, studentName) {
	if ( schoolID == undefined )
		schoolID = 0;
	
	if ( schoolCCT == undefined )
		schoolCCT = '';
	
	if ( groupID == undefined )
		groupID = 0;
	
	if ( studentID == undefined )
		studentID = 0;
	
	if ( studentName == undefined )
		studentName = 'Undefined Name';
	
		var		tableRow			= $('.table.table-schools-groups-students-root .table-rows#schoolid_' + schoolID + '_schoolcct_' + schoolCCT + '_groupid_' + groupID + '_studentid_' + studentID + ''),
				tableRows			= $('.table.table-schools-groups-students-root .table-list .table-rows');
				oldColor			= tableRow.css('background-color'),
				bodyMessenger		= $('.body-messenger'),
				dashboardMessenger	= $('.dashboard-messenger');
		tableRow.css('background-color', '#ed1c24');
		if ( confirm ('¿Realmente desea eliminar al alumno "' + studentName + '"?') ) {
			bodyMessenger.html('<span class="bar-message-alert">cargando&#133;</span>').fadeIn(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_students&m=deletestudent_attempt',
					data		: 'studentID=' + studentID + '',
					success		: function (successContentLoaderRequest) {
						
						tableRow.slideUp(showtimer, function () {
							tableRow.remove();
							dashboardMessenger.slideUp(showtimer, function () {
								dashboardMessenger.html('<span class="bar-success" style="margin-top: 10px;">El alumno <b>"' + studentName + ' "</b> se ha dado de baja.</span>').slideDown(showtimer, function () {
									if ( dashboardTimeOut != undefined )
										clearTimeout(dashboardTimeOut);
									
									var dashboardTimeOut = setTimeout(function () {
										dashboardMessenger.slideUp(showtimer);
									}, 10000);
									
									var rowcounter = 0;
									$('.table-rows').each(function () {
										var row = $(this);
										row.removeClass('odd');
										if ( rowcounter == 1 ) {
											row.addClass('odd');
											rowcounter = 0;
										}
										else if ( rowcounter == 0 )
											rowcounter = 1;
									});
								});
							});
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
							if ( (tableRows.length - 1) == 0 ) {
								$('.table.table-schools-groups-students .table-list').html('<span class="table-rows empty-row">Usted no ha registrado ningún alumno</span>');
							}
						});
						
					},
					error		: function (errorjqXHRContentLoaderRequest, errorTxtContentLoaderRequest, errorThrownContentLoaderRequest) {
						bodyMessenger.html('<span class="bar-message-error">#' + errorjqXHRContentLoaderRequest.status + ' ' + errorThrownContentLoaderRequest + '</span>');
						setTimeout(function () {
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
						}, 10000);
					}
				});
			});
		}
		else
			tableRow.css('background-color', oldColor);
}
// end: deleteStudentAttempt_root





/**
 * 
 * addGroupAttepmt_root
 * 
 * function to add group to the database
 */
function addGroupAttepmt_root () {
	var		addgroup_submitButton				= $('.form .form-addgroup-root .form-actions .button.submit'),
			addgroup_form_messenger				= $('.form .form-addgroup-root .form-messenger'),
			addgroup_spiner						= $('.form .form-addgroup-root .form-actions .spinner-16x16'),
			addgroup_schoolID					= $('.form .form-addgroup-root input[type=hidden]#addgroup-schoolID').val(),
			addgroup_name						= $('.form .form-addgroup-root .form-row .row-field .ftext#addgroup-name').val(),
			addgroup_grade						= $('.form .form-addgroup-root .form-row .row-field .fselect#addgroup-grade').val(),
			addgroup_postdata					=	'group_schoolID=' + addgroup_schoolID +
													'&group_name=' + addgroup_name +
													'&group_grade=' + addgroup_grade;
	
	addgroup_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		addgroup_spiner.css({
			'height' : addgroup_submitButton.height(),
			'width' : addgroup_submitButton.width(),
			'padding-top' : addgroup_submitButton.css('padding-top') - 1,
			'padding-bottom' : addgroup_submitButton.css('padding-bottom'),
			'padding-left' : addgroup_submitButton.css('padding-left'),
			'padding-right' : addgroup_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			addgroup_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=addgroup_attempt',
					data		: addgroup_postdata,
					success		: function (successaddgroupRequest) {
						addgroup_form_messenger.slideUp(showtimer, function () {
							addgroup_form_messenger.html(successaddgroupRequest).slideDown(showtimer);
						});
					},
					error		: function (erroraddgroupRequest, errorTxtaddgroupRequest, errorThrownaddgroupRequest) {
						addgroup_form_messenger.slideUp(showtimer, function () {
							addgroup_form_messenger.html('<span class="bar-error">' + erroraddgroupRequest.status + ' ' + errorThrownaddgroupRequest + '</span>').slideDown(showtimer);
							addgroup_spiner.fadeOut(0, function () {
								addgroup_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: addGroupAttepmt_root





/**
 * 
 * deleteGroupAttempt_root
 */
function deleteGroupAttempt_root (schoolID, schoolCCT, groupID, groupName, groupGrade) {
	
	if ( schoolID == undefined )
		schoolID = 0;
	
	if ( schoolCCT == undefined )
		schoolCCT = '';
	
	if ( groupID == undefined )
		groupID = 0;
	
	if ( groupName == undefined )
		groupName = 'A';
	
	if ( groupGrade == undefined )
		groupGrade = '0';
	
		var		tableRow			= $('.table.table-schools-groups-root .table-rows#schoolid_' + schoolID + '_schoolcct_' + schoolCCT + '_groupid_' + groupID + ''),
				tableRows			= $('.table.table-schools-groups-root .table-list .table-rows');
				oldColor			= tableRow.css('background-color'),
				bodyMessenger		= $('.body-messenger'),
				dashboardMessenger	= $('.dashboard-messenger');
		tableRow.css('background-color', '#ed1c24');
		if ( confirm ('¿Realmente desea eliminar el grupo "' + groupGrade + '° ' + groupName + '"?') ) {
			bodyMessenger.html('<span class="bar-message-alert">cargando&#133;</span>').fadeIn(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=deletegroup_attempt',
					data		: 'groupID=' + groupID + '',
					success		: function (successContentLoaderRequest) {
						
						tableRow.slideUp(showtimer, function () {
							tableRow.remove();
							dashboardMessenger.slideUp(showtimer, function () {
								dashboardMessenger.html('<span class="bar-success" style="margin-top: 10px;">El grupo <b>"' + groupGrade + ' ' + groupName + ' "</b> ha sido eliminado.</span>').slideDown(showtimer, function () {
									if ( dashboardTimeOut != undefined )
										clearTimeout(dashboardTimeOut);
									
									var dashboardTimeOut = setTimeout(function () {
										dashboardMessenger.slideUp(showtimer);
									}, 10000);
									
									var rowcounter = 0;
									$('.table-rows').each(function () {
										var row = $(this);
										row.removeClass('odd');
										if ( rowcounter == 1 ) {
											row.addClass('odd');
											rowcounter = 0;
										}
										else if ( rowcounter == 0 )
											rowcounter = 1;
									});
								});
							});
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
							if ( (tableRows.length - 1) == 0 ) {
								$('.table.table-schools-groups-root .table-list').html('<span class="table-rows empty-row">Usted no ha registrado ningún grupo</span>');
							}
						});
						
					},
					error		: function (errorjqXHRContentLoaderRequest, errorTxtContentLoaderRequest, errorThrownContentLoaderRequest) {
						bodyMessenger.html('<span class="bar-message-error">#' + errorjqXHRContentLoaderRequest.status + ' ' + errorThrownContentLoaderRequest + '</span>');
						setTimeout(function () {
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
						}, 10000);
					}
				});
			});
		}
		else
			tableRow.css('background-color', oldColor);
}
// end: deleteGroupAttempt_root





/**
 * 
 * editGroupAttepmt_root
 * 
 * function to attempt to edit group info
 */
function editGroupAttepmt_root () {
	var		editgroup_submitButton				= $('.form .form-editgroup-root .form-actions .button.submit'),
			editgroup_form_messenger			= $('.form .form-editgroup-root .form-messenger'),
			editgroup_spiner					= $('.form .form-editgroup-root .form-actions .spinner-16x16'),
			editgroup_id						= $('.form .form-editgroup-root input[type=hidden]#editgroup-groupID').val(),
			editgroup_grade						= $('.form .form-editgroup-root .form-row .row-field .fselect#editgroup-grade').val(),
			editgroup_name						= $('.form .form-editgroup-root .form-row .row-field .ftext#editgroup-name').val(),
			editgroup_postdata					=	'groupID=' + editgroup_id +
													'&grade=' + editgroup_grade +
													'&name=' + editgroup_name;
	
	editgroup_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		editgroup_spiner.css({
			'height' : editgroup_submitButton.height(),
			'width' : editgroup_submitButton.width(),
			'padding-top' : editgroup_submitButton.css('padding-top') - 1,
			'padding-bottom' : editgroup_submitButton.css('padding-bottom'),
			'padding-left' : editgroup_submitButton.css('padding-left'),
			'padding-right' : editgroup_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			editgroup_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=editgroup_attempt',
					data		: editgroup_postdata,
					success		: function (successeditgroupRequest) {
						editgroup_form_messenger.slideUp(showtimer, function () {
							editgroup_form_messenger.html(successeditgroupRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditgroupRequest, errorTxteditgroupRequest, errorThrowneditgroupRequest) {
						editgroup_form_messenger.slideUp(showtimer, function () {
							editgroup_form_messenger.html('<span class="bar-error">' + erroreditgroupRequest.status + ' ' + errorThrowneditgroupRequest + '</span>').slideDown(showtimer);
							editgroup_spiner.fadeOut(0, function () {
								editgroup_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: editGroupAttepmt_root





/**
 * 
 * editProfileAttempt_root
 * 
 * function to send a request to edit user info
 */
function editProfileAttempt_root () {
	
	var		edituser_submitButton		= $('.form .form-edituserinfo-root .form-actions .button.submit'),
			edituser_userid				= $('.form .form-edituserinfo-root input[type=hidden]#edituser-userid').val(),
			edituser_firstname			= $('.form .form-edituserinfo-root .form-row .row-field .ftext#edituser-firstname').val(),
			edituser_lastname			= $('.form .form-edituserinfo-root .form-row .row-field .ftext#edituser-lastname').val(),
			edituser_useremail			= $('.form .form-edituserinfo-root .form-row .row-field .ftext#edituser-usermail').val(),
			edituser_usercurp			= $('.form .form-edituserinfo-root .form-row .row-field .ftext#edituser-usercurp').val(),
			edituser_userusaer			= $('.form .form-edituserinfo-root .form-row .row-field .ftext#edituser-userusaer').val(),
			edituser_userusaerzone		= $('.form .form-edituserinfo-root .form-row .row-field .ftext#edituser-userusaerzone').val(),
			edituser_usercrosee			= $('.form .form-edituserinfo-root .form-row .row-field .fselect#edituser-usercrosee').val(),
			edituser_usertype			= $('.form .form-edituserinfo-root .form-row .row-field .fselect#edituser-usertype').val(),
			edituser_form_messenger		= $('.form .form-edituserinfo-root .form-messenger'),
			edituser_spiner				= $('.form .form-edituserinfo-root .form-actions .spinner-16x16'),
			edituser_postdata			= 'userid=' + edituser_userid + '&firstname=' + edituser_firstname + '&lastname=' + edituser_lastname + '&useremail=' + edituser_useremail + '&usercurp=' + edituser_usercurp + '&userusaer=' + edituser_userusaer + '&userusaerzone=' + edituser_userusaerzone + '&usercrosee=' + edituser_usercrosee + '&usertype=' + edituser_usertype + '';
	
	
	edituser_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		edituser_spiner.css({
			'height' : edituser_submitButton.height(),
			'width' : edituser_submitButton.width(),
			'padding-top' : edituser_submitButton.css('padding-top') - 1,
			'padding-bottom' : edituser_submitButton.css('padding-bottom'),
			'padding-left' : edituser_submitButton.css('padding-left'),
			'padding-right' : edituser_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			edituser_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=useredit_attempt',
					data		: edituser_postdata,
					success		: function (successEditProfileRequest) {
						edituser_form_messenger.slideUp(showtimer, function () {
							edituser_form_messenger.html(successEditProfileRequest).slideDown(showtimer);
						});
					},
					error		: function (errorEditProfileRequest, errorTxtEditProfileRequest, errorThrownEditProfileRequest) {
						edituser_form_messenger.slideUp(showtimer, function () {
							edituser_form_messenger.html('<span class="bar-error">' + errorEditProfileRequest.status + ' ' + errorThrownEditProfileRequest + '</span>').slideDown(showtimer);
							edituser_spiner.fadeOut(0, function () {
								edituser_submitButton.fadeIn(0);
							});
						});
					}
				});
			});
		});
	});
}
// end: editProfileAttempt_root





/**
 * 
 * delete_user
 */
/**
 * 
 * delete_user_attempt
 * 
 * function to attempt to delete student 
 */
function delete_user_attempt (userid, username) {
	if ( userid != undefined ) {
		
		if ( username == undefined ) username = 'usuario';
		
		var		tableRow			= $('.table.table-schools-groups-users-root .table-list .table-rows#tablerow-userid_' + userid + ''),
				tableRows			= $('.table.table-schools-groups-users-root .table-list .table-rows');
				oldColor			= tableRow.css('background-color'),
				bodyMessenger		= $('.body-messenger'),
				dashboardMessenger	= $('.dashboard-messenger');
				tableRow.css('background-color', '#ed1c24');
		if ( confirm ('¿Realmente desea eliminar al usuario "' + username + '"?\n\nEste cambio hará que usted sea el dueño de todo lo que el usuario realizo en el sistema.\n\nESTE CAMBIO NO SE PUEDE DESHACER') ) {
			bodyMessenger.html('<span class="bar-message-alert">cargando&#133;</span>').fadeIn(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=delete_user',
					data		: 'userid=' + userid + '',
					success		: function (successContentLoaderRequest) {
						
						tableRow.slideUp(showtimer, function () {
							tableRow.remove();
							dashboardMessenger.slideUp(showtimer, function () {
								dashboardMessenger.html('<span class="bar-success" style="margin-top: 10px;">El usuario <b>"' + username + ' "</b> se ha dado de baja.</span>').slideDown(showtimer, function () {
									if ( dashboardTimeOut != undefined )
										clearTimeout(dashboardTimeOut);
									
									var dashboardTimeOut = setTimeout(function () {
										dashboardMessenger.slideUp(showtimer);
									}, 10000);
									
									var rowcounter = 0;
									$('.table-rows').each(function () {
										var row = $(this);
										row.removeClass('odd');
										if ( rowcounter == 1 ) {
											row.addClass('odd');
											rowcounter = 0;
										}
										else if ( rowcounter == 0 )
											rowcounter = 1;
									});
								});
							});
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
							if ( (tableRows.length - 1) == 0 ) {
								$('.table.table-schools-groups-users-root .table-list').html('<span class="table-rows empty-row">No se ha registrado ningún usuario</span>');
							}
						});
						
					},
					error		: function (errorjqXHRContentLoaderRequest, errorTxtContentLoaderRequest, errorThrownContentLoaderRequest) {
						bodyMessenger.html('<span class="bar-message-error">#' + errorjqXHRContentLoaderRequest.status + ' ' + errorThrownContentLoaderRequest + '</span>');
						setTimeout(function () {
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
						}, 10000);
					}
				});
			});
		}
		else
			tableRow.css('background-color', oldColor);
	}
	else
		alert("No se pudo obtener el ID del usuario");
}
// end: delete_user_attempt





/**
 * toggleAppStatus
 */
function toggleAppStatus (appid) {
	if ( appid == undefined ) appid = 0;
	
	var				bodyMessenger		= $('.body-messenger'),
					dashboardMessenger	= $('.dashboard-messenger');
	$.ajax({
		type		: 'POST',
		url			: __BASEPATH + '?c=secundaria_profile_root&m=toggle_app_status',
		data		: 'appid=' + appid + '',
		success		: function (successAppStatusRequest) {
			dashboardMessenger.slideUp(showtimer, function () {
				$(this).html('<span class="bar-success">la aplicación ha actualizado su estado.</span>' + successAppStatusRequest).slideDown(showtimer);
			});
		},
		error		: function (errorjqXHRAppStatus, errorjqXHRAppStatusText, errorjqXHRAppStatusThrown) {
			dashboardMessenger.slideUp(showtimer, function () {
				$(this).html('<span class="bar-error">error ' + errorjqXHRAppStatus.status + ' ' + errorjqXHRAppStatusThrown + '</span>').slideDown(showtimer);
			});
		}
	});
}
// end: toggleAppStatus





/**
 * addAppAttempt_root
 */
function addAppAttempt_root () {
	var		addapp_submitButton				= $('.form .form-addapp-root .form-actions .button.submit'),
			addapp_form_messenger			= $('.form .form-addapp-root .form-messenger'),
			addapp_spiner					= $('.form .form-addapp-root .form-actions .spinner-16x16'),
			addapp_app_name					= $('.form .form-addapp-root .form-row .row-field .ftext#addapp-appname').val(),
			addapp_app_date					= $('.form .form-addapp-root .form-row .row-field .ftext#addapp-appdate').val(),
			addapp_app_description			= $('.form .form-addapp-root .form-row .row-field .ftext#addapp-appdescription').val(),
			addapp_postdata					=	'app_name='				+ addapp_app_name			+
												'&app_date='			+ addapp_app_date			+
												'&app_description='		+ addapp_app_description	;
	
	addapp_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		addapp_spiner.css({
			'height' : addapp_submitButton.height(),
			'width' : addapp_submitButton.width(),
			'padding-top' : addapp_submitButton.css('padding-top') - 1,
			'padding-bottom' : addapp_submitButton.css('padding-bottom'),
			'padding-left' : addapp_submitButton.css('padding-left'),
			'padding-right' : addapp_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			addapp_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=window_add_app_attempt',
					data		: addapp_postdata,
					success		: function (successaddappRequest) {
						addapp_form_messenger.slideUp(showtimer, function () {
							addapp_form_messenger.html(successaddappRequest).slideDown(showtimer);
						});
					},
					error		: function (erroraddappRequest, errorTxtaddappRequest, errorThrownaddappRequest) {
						addapp_form_messenger.slideUp(showtimer, function () {
							addapp_form_messenger.html('<span class="bar-error">' + erroraddappRequest.status + ' ' + errorThrownaddappRequest + '</span>').slideDown(showtimer);
							addapp_spiner.fadeOut(0, function () {
								addapp_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: addAppAttempt_root





/**
 * editAppAttempt_root
 */
function editAppAttempt_root () {
	var		editapp_submitButton			= $('.form .form-editapp-root .form-actions .button.submit'),
			editapp_form_messenger			= $('.form .form-editapp-root .form-messenger'),
			editapp_spiner					= $('.form .form-editapp-root .form-actions .spinner-16x16'),
			editapp_app_id					= $('.form .form-editapp-root input[type=hidden]#updateapp-appid').val(),
			editapp_app_name				= $('.form .form-editapp-root .form-row .row-field .ftext#updateapp-appname').val(),
			editapp_app_date				= $('.form .form-editapp-root .form-row .row-field .ftext#updateapp-appdate').val(),
			editapp_app_description			= $('.form .form-editapp-root .form-row .row-field .ftext#updateapp-appdescription').val(),
			editapp_postdata				=	'app_id='				+ editapp_app_id			+
												'&app_name='			+ editapp_app_name			+
												'&app_date='			+ editapp_app_date			+
												'&app_description='		+ editapp_app_description	;
	
	editapp_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		editapp_spiner.css({
			'height' : editapp_submitButton.height(),
			'width' : editapp_submitButton.width(),
			'padding-top' : editapp_submitButton.css('padding-top') - 1,
			'padding-bottom' : editapp_submitButton.css('padding-bottom'),
			'padding-left' : editapp_submitButton.css('padding-left'),
			'padding-right' : editapp_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			editapp_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=window_update_app_attempt',
					data		: editapp_postdata,
					success		: function (successeditappRequest) {
						editapp_form_messenger.slideUp(showtimer, function () {
							editapp_form_messenger.html(successeditappRequest).slideDown(showtimer);
						});
					},
					error		: function (erroreditappRequest, errorTxteditappRequest, errorThrowneditappRequest) {
						editapp_form_messenger.slideUp(showtimer, function () {
							editapp_form_messenger.html('<span class="bar-error">' + erroreditappRequest.status + ' ' + errorThrowneditappRequest + '</span>').slideDown(showtimer);
							editapp_spiner.fadeOut(0, function () {
								editapp_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: editAppAttempt_root





/**
 * 
 * deleteAppAttempt
 */
function deleteAppAttempt (appid, appname) {
	if ( appid != undefined ) {
		
		if ( appname == undefined ) appname = 'applicación';
		
		var		tableRow			= $('.table.table-apps-root .table-list .table-rows#tableappid_' + appid + ''),
				tableRows			= $('.table.table-apps-root .table-list .table-rows');
				oldColor			= tableRow.css('background-color'),
				bodyMessenger		= $('.body-messenger'),
				dashboardMessenger	= $('.dashboard-messenger');
				tableRow.css('background-color', '#ed1c24');
		if ( confirm ('¿Realmente desea eliminar la aplicación "' + appname + '"?\n\nLa aplicación, las preguntas correspondientes a esta aplicación y\nlas respuestas correspondientes a esta aplicación se veran afectadas también.\n\nESTE CAMBIO NO SE PUEDE DESHACER') ) {
			bodyMessenger.html('<span class="bar-message-alert">cargando&#133;</span>').fadeIn(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=delete_app',
					data		: 'appid=' + appid + '',
					success		: function (successContentLoaderRequest) {
						
						tableRow.slideUp(showtimer, function () {
							tableRow.remove();
							dashboardMessenger.slideUp(showtimer, function () {
								dashboardMessenger.html('<span class="bar-success" style="margin-top: 10px;">La aplicación <b>"' + appname + ' "</b> se ha dado de baja.</span>').slideDown(showtimer, function () {
									if ( dashboardTimeOut != undefined )
										clearTimeout(dashboardTimeOut);
									
									var dashboardTimeOut = setTimeout(function () {
										dashboardMessenger.slideUp(showtimer);
									}, 10000);
									
									var rowcounter = 0;
									$('.table-rows').each(function () {
										var row = $(this);
										row.removeClass('odd');
										if ( rowcounter == 1 ) {
											row.addClass('odd');
											rowcounter = 0;
										}
										else if ( rowcounter == 0 )
											rowcounter = 1;
									});
								});
							});
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
							if ( (tableRows.length - 1) == 0 ) {
								$('.table.table-apps-root .table-list').html('<span class="table-rows empty-row">No se ha registrado ninguna aplicación</span>');
							}
						});
						
					},
					error		: function (errorjqXHRContentLoaderRequest, errorTxtContentLoaderRequest, errorThrownContentLoaderRequest) {
						bodyMessenger.html('<span class="bar-message-error">#' + errorjqXHRContentLoaderRequest.status + ' ' + errorThrownContentLoaderRequest + '</span>');
						setTimeout(function () {
							bodyMessenger.fadeOut(0, function () {
								bodyMessenger.html('').fadeIn(0);
							});
						}, 10000);
					}
				});
			});
		}
		else
			tableRow.css('background-color', oldColor);
	}
	else
		alert("No se pudo obtener el ID de la aplicación");
}
// end: deleteAppAttempt





/**
 * addAppQuestionAttempt_root
 */
function addAppQuestionAttempt_root () {
	var		addapp_question_submitButton			= $('.form .form-addquestion-root .form-actions .button.submit'),
			addapp_question_form_messenger			= $('.form .form-addquestion-root .form-messenger'),
			addapp_question_spiner					= $('.form .form-addquestion-root .form-actions .spinner-16x16'),
			addapp_question_app_text				= $('.form .form-addquestion-root .form-row .row-field .ftext#addquestion-question-content').val(),
			addapp_question_app_type				= $('.form .form-addquestion-root .form-row .row-field .fselect#addquestion-question-type').val(),
			addapp_question_app_id					= $('.form .form-addquestion-root input[type=hidden]#addquestion-app-id').val(),
			addapp_question_postdata				=	'appid='					+ addapp_question_app_id			+
														'&app_question_text='		+ addapp_question_app_text			+
														'&app_question_type='		+ addapp_question_app_type			;
	
	addapp_question_form_messenger.slideUp(showtimer, function () {
		lockFormFields();
		addapp_question_spiner.css({
			'height' : addapp_question_submitButton.height(),
			'width' : addapp_question_submitButton.width(),
			'padding-top' : addapp_question_submitButton.css('padding-top') - 1,
			'padding-bottom' : addapp_question_submitButton.css('padding-bottom'),
			'padding-left' : addapp_question_submitButton.css('padding-left'),
			'padding-right' : addapp_question_submitButton.css('padding-right'),
			'border' : '1px solid transparent',
			'display' : 'inline-block'
		}).fadeIn(0, function () {
			addapp_question_submitButton.fadeOut(0, function () {
				$.ajax({
					type		: 'POST',
					url			: __BASEPATH + '?c=secundaria_profile_root&m=window_add_app_question_attempt',
					data		: addapp_question_postdata,
					success		: function (successaddapp_questionRequest) {
						addapp_question_form_messenger.slideUp(showtimer, function () {
							addapp_question_form_messenger.html(successaddapp_questionRequest).slideDown(showtimer);
						});
					},
					error		: function (erroraddapp_questionRequest, errorTxtaddapp_questionRequest, errorThrownaddapp_questionRequest) {
						addapp_question_form_messenger.slideUp(showtimer, function () {
							addapp_question_form_messenger.html('<span class="bar-error">' + erroraddapp_questionRequest.status + ' ' + errorThrownaddapp_questionRequest + '</span>').slideDown(showtimer);
							addapp_question_spiner.fadeOut(0, function () {
								addapp_question_submitButton.fadeIn(0);
								unlockFormFields();
							});
						});
					}
				});
			});
		});
	});
}
// end: addAppQuestionAttempt_root