<?php

return [
    'no_space'  => "No space please and don't leave it empty",
    'no_space_password'     => "Please enter valid password",
    'valid_mobile'          => "Please insert valid mobile number",
    'valid_password'        => "Password required at least 8 characters with one uppercase letter,one lowercase letter, numbers, special character",
    'web'=>[
        'only_image_validation' => 'Please upload jpg,png,jpeg image only',
        'landing_page' => [
            'title' => 'Rise'
        ],
        'user' => [
            'profile_photo_required'            => 'Please select profile image',
            'company_name'        => 'Please enter company name',
            'registration_id_required'          => 'Please enter EIN',
            'email_required'                    => 'Please enter email address',
            // 'password_required'                 => 'Please enter password',
            'password_required'                 => "Password required at least 8 character with one uppercase letter,one lowercase letter, numbers, special character",
            "confirm_password_required"         => "Confirm password required at least 8 character with one uppercase letter,one lowercase letter, numbers, special character",
            'email_format'                      => 'Please enter valid email address.',
            'pwcheck'                           => 'Password is not strong enough',
            'checklower'                        => 'Need atleast 1 lowercase letter',
            'checkupper'                        => 'Need atleast 1 uppercase letter',
            'checkdigit'                        => 'Need atleast 1 digit',
            'contact_number_required'           => 'Please enter contact number',
            'address_required'                  => 'Please enter address',
            'bio_required'                      => 'Please enter description',
            'organization_register_success'     => 'You have Successfully Registered',
            'confirm_password_required'         => 'Please enter confirm password',
            'equal_pass'                        => 'Enter Confirm Password Same as Password',
            'profile_update_success'            => 'Organization profile has been updated successfully',

            'old_password_required'         => 'Old password is required',
            'new_password_required'         => 'New password is required',
            'confirm_password_required'     => 'Confirm password is required',
            'confirm_new_password_not_match'    => 'Confim password and new password should be same',
            'toscheck_required' => 'By creating an account, you must agree to accept our terms of service.'
            
          
        ]
    ],
    // API messages
    'api' => [
      
    ],
    // Admin messages
    'admin' => [
        'logout'    => 'You successfully logout from admin panel',
        'user' => [
            'email_required'                    => 'Please enter email address',
            'password_required'                 => 'Please enter password',
            'email_format'                      => 'Your email address must be in the format of name@domain.com',
            'update_profile_success'            => 'Profile updated successfully',
            'update_password_success'           => 'Password updated successfully',
            'old_password_required'             => 'Old password is required',
            'new_password_required'             => 'New password is required',
            'confirm_password_required'         => 'Confirm password is required',
            'current_password_not_match'        => 'Current password does not match',
            'new_password_minlength'            => 'Password cannot less than 6 characters',
            'new_password_maxlength'            => 'Password cannot greater than 20 characters',
            'confirm_password_minlength'        => 'Confim password cannot less than 6 characters',
            'confirm_password_maxlength'        => 'Confim password cannot greater than 20 characters',
            'confirm_new_password_not_match'    => 'Confim password and new password should be same',
            'delete_user_success'               => 'User has been delete successfully'
        ],
        'setting' => [
            'update_success' => 'Data Insert Successfully',
        ]
    ],
];