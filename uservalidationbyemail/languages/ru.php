<?php
/**
 * Email user validation plugin language pack.
 *
 * @package Elgg.Core.Plugin
 * @subpackage ElggUserValidationByEmail
 */

$russian = array(
	'admin:users:unvalidated' => 'Не подтвержден',
	
	'email:validate:subject' => "%s, пожалуйста, подтвердите ваш электронный адрес.",
	'email:validate:body' => "Здравствуйте, %s!

Пожалуйста, подтвердите Ваш электронный адрес, нажав сюда:

%s
",
	'email:confirm:success' => "Спасибо, что подтвердили email адрес!",
	'email:confirm:fail' => "Ваш email не подтвержден...",

	'uservalidationbyemail:registerok' => "Для активации аккаунта подтвердите Ваш электронный адрес, нажав на ссылку, которую мы Вам прислали.",
	'uservalidationbyemail:login:fail' => "Your account is not validated so the log in attempt failed. Another validation email has been sent.",

	'uservalidationbyemail:admin:no_unvalidated_users' => 'No unvalidated users.',

	'uservalidationbyemail:admin:unvalidated' => 'Unvalidated',
	'uservalidationbyemail:admin:user_created' => 'Registered %s',
	'uservalidationbyemail:admin:resend_validation' => 'Resend validation',
	'uservalidationbyemail:admin:validate' => 'Validate',
	'uservalidationbyemail:admin:delete' => 'Delete',
	'uservalidationbyemail:confirm_validate_user' => 'Validate %s?',
	'uservalidationbyemail:confirm_resend_validation' => 'Resend validation email to %s?',
	'uservalidationbyemail:confirm_delete' => 'Delete %s?',
	'uservalidationbyemail:confirm_validate_checked' => 'Validate checked users?',
	'uservalidationbyemail:confirm_resend_validation_checked' => 'Resend validation to checked users?',
	'uservalidationbyemail:confirm_delete_checked' => 'Delete checked users?',
	'uservalidationbyemail:check_all' => 'All',

	'uservalidationbyemail:errors:unknown_users' => 'Unknown users',
	'uservalidationbyemail:errors:could_not_validate_user' => 'Could not validate user.',
	'uservalidationbyemail:errors:could_not_validate_users' => 'Could not validate all checked users.',
	'uservalidationbyemail:errors:could_not_delete_user' => 'Could not delete user.',
	'uservalidationbyemail:errors:could_not_delete_users' => 'Could not delete all checked users.',
	'uservalidationbyemail:errors:could_not_resend_validation' => 'Could not resend validation request.',
	'uservalidationbyemail:errors:could_not_resend_validations' => 'Could not resend all validation requests to checked users.',

	'uservalidationbyemail:messages:validated_user' => 'User validated.',
	'uservalidationbyemail:messages:validated_users' => 'All checked users validated.',
	'uservalidationbyemail:messages:deleted_user' => 'User deleted.',
	'uservalidationbyemail:messages:deleted_users' => 'All checked users deleted.',
	'uservalidationbyemail:messages:resent_validation' => 'Validation request resent.',
	'uservalidationbyemail:messages:resent_validations' => 'Validation requests resent to all checked users.'

);

add_translation("ru", $russian);