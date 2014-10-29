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
							url			: __BASEPATH + 'js/primaria/jq.helper.js',
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
						url			: __BASEPATH + '?c=primaria_sessions&m=login_attempt',
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
		var forgotPasswdSpinner		= $('.form .form-forgotpasswd .form-actions .spinner-16x16'),
			forgotPasswdSubmitButton	= $('.form .form-forgotpasswd .form-actions .button.submit'),
			forgotPasswdFormMessenger	= $('.form .form-forgotpasswd .form-messenger'),
			usermail			= $('.form .form-forgotpasswd .form-row .row-field .ftext#forgotpasswd-usermail').val(),
			forgotPasswdData	= 'usermail=' + usermail + '';
			
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
					url			: __BASEPATH + '?c=primaria_sessions&m=forgotpasswd_attempt',
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
					url			: __BASEPATH + '?c=primaria_sessions&m=registeruser_attempt',
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
						url			: __BASEPATH + 'js/primaria/jq.window.js',
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
					url			: __BASEPATH + '?c=primaria_users&m=useredit_attempt',
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
					url			: __BASEPATH + '?c=primaria_users&m=passwdedit_attempt',
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
					url			: __BASEPATH + '?c=primaria_schools&m=deleteSchool_attempt',
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
					url			: __BASEPATH + '?c=primaria_schools&m=addschool_attempt',
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
					url			: __BASEPATH + '?c=primaria_schools&m=editSchool_attempt',
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
					url			: __BASEPATH + '?c=primaria_groups&m=addgroup_attempt',
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
					url			: __BASEPATH + '?c=primaria_groups&m=deletegroup_attempt',
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
					url			: __BASEPATH + '?c=primaria_groups&m=editgroup_attempt',
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
					url			: __BASEPATH + '?c=primaria_students&m=addstudent_attempt',
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
					url			: __BASEPATH + '?c=primaria_students&m=deletestudent_attempt',
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
					url			: __BASEPATH + '?c=primaria_students&m=editstudent_attempt',
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
	
	alert("Esta área es solo una muestra de como funcionará el sistema\nmantengase atento a las indicaciones que se le darán atraves de su enlace técnico.");
	window.top.location.href = __BASEPATH + "?c=primaria";
	/*
	var incorrect_answers	= new Array(),
		correct_answers		= new Array();
	
	$('.table .table-rows .col-title.col-answer .answer-item .radio-answer').each(function () {
		
	});
	*/
	
	/*
	var answer_counter = 0;
	$('.table .table-rows .col-title.col-answer .answer-item .radio-answer').each(function () {
		var radio_answer	= $(this),
			radio_id		= radio_answer.attr('id'),
			radio_checked	= radio_answer.attr('checked'),
			radio_value		= radio_answer.val();
		if ( radio_checked == 'checked' ) {
			alert('"' + radio_id + '" is checked and the value is ' + radio_value);
			answer_counter++;
		}
	});
	
	if ( answer_counter == 45 ) {
		alert("guardando ... ");
	}
	else if ( answer_counter < 45 ) {
		alert('no has terminado de contestar las preguntas, por favor completalas y después das click en "Finalizar mi encuesta"');
	}
	*/
}
