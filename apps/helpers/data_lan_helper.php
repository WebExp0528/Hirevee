<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package CodeIgniter
 * @author Anil Kumar Panigrahi
 * @link http://codeigniter.com
 * @since Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------


/**
 * CodeIgniter Translate Helpers
 *
 * @package CodeIgniter
 * @subpackage Helpers
 * @category Helpers
 * @author Anil Kumar Panigrahi
// On date 12-05-2010

 */

// ------------------------------------------------------------------------


/**
 * Translate
 *
 * $s - default source language ( English )
 * $d - Destination language ( French , Spanish ... )
 * Converted the string using google translate API.
 * @return string
 */

if (! function_exists ( 'get_language_data' )) {
	function get_language_data() {
		$data = array(			
		'about'	=>	'About',	
		'Blog'	=>	'Blog',
		'Members'	=>	'Members',
		'Sign in'	=>	'Sign in',
		'Sign out'	=>	'Sign out',
		'Sign up'	=>	'Sign up',	
		'Contact us'	=>	'Contact us',
		'sendmessage_btn'	=>	'Send Message',
		'Find us here'	=>	'Find us here',
		'Address'	=>	'Address',
		'Mobile'	=>	'Mobile',
		'Email'	=>	'Email',		
		'Interview staff'	=>	'Interview staff',
		'IN YOUR OWN TIME'	=>	'IN YOUR OWN TIME',
		'About our company'	=>	'About our company',
		'Employers & Recruiters'	=>	'Employers & Recruiters',
		'Prospective Staff'	=>	'Prospective Staff',
		'Twitter feed'	=>	'Twitter feed',
		'From the Blog'	=>	'From the Blog',
		'Popular posts'	=>	'Popular posts',
		'addblog_btn'	=>	'Add blog',
		'Categories'	=>	'Categories',
		'Lastest posts'	=>	'Lastest posts',
		'Twitter feed'	=>	'Twitter feed',
		'linked in'	=>	'linked in',
		'notify'=> 'There is no Blog!',
		'Author'=> ' Author',
		'comments'=> 'comments',		
		'Leave a reply'=> 'Leave a reply',
		'Post comment'=> 'post comment',
		'select category'=> 'Select Category',
		'Type Subject'=> "Type Subject",
		'cancel_btn'=>'cancel',
		'Recruiters'=>'Recruiters',	
		'Employees'=>'Employees',	
		'Enter Code'=>'Enter Code',	
//----------------------------recruiter_language------------
		'home'	=>	'Home',				//-----------header
		'jobs'	=>	'Jobs',
		'clients'	=>	'Clients',
		'profiles'	=>	'Profiles',
		'add'	=>	'+add',		
		//-------------------------- rc_home
	    'date' => 'Date',
	    'name' => 'Name',
	    'job position'=> 'Job Position',
	    'rating' => 'Rating',
	    'share' => 'Share',
	    'watch' => 'Watch',
    	'transaction' => 'Transaction',
	    'balance' => 'Balance',
		'from' => 'From',
		'to' => 'To',
	    'download as cvs' => 'downlaod as CSV',
		'type' => 'Type',
		'description' => 'Description',
		'agency' => 'Agency',
		'contractor' => 'Contractor',
		'amount' => 'Amount',
		'balance' => 'Balance',
		'go' => 'Go',
		//------------------------ rc_jobs
		'jobs' => 'Jobs',
		'clients' => 'Clients',		
		'share' => 'Share',
		'save comment'	=>	'Save Comment',
		'type comment'	=>	'TYPE YOUR COMMENT HERE',
		//----------------------------rc_addfund
		'add funds' => 'Add Funds',
		'current account balance' => 'Current Account Balance',
		'pay-as-you-go' => 'Pay-as-you-go credits package',
		'next' => 'Next',
		//----------------------------------rc_addjob
		'create new job' => 'Create New Job',
		'add new client' => 'Add New Client',
		
		'about the position' => 'About the position',
		'seeking staff' => 'Seeking staff',
		'questions' => 'Questions',
		'question' => 'Question',
		'job name' => 'Job Name',
		'job description' => 'Job Description',
		'closing date' => 'Closing date',
		'first name' => 'First name',
		'sure name' => 'Sure name',
		'e-mail' => 'E-mail',
		'total cost' => 'Total Cost',
		'submit' => 'Submit',
		'add more' => 'Add More',
		//-------------------------rc_profile
		'profile' => 'Profile',	
		'change banner color'	=>	'Change Banner Color',
		'add opening profile video'	=>	'Add Opening Profile Video',
		'jobs-prof'	=>	'JOBS',
		'industries' =>	'INDUSTRIES',
		'questions-prof'	=>	'QUESTIONS',
		'add job'	=>	'Add Job',
		'add industries' => 'Add Industries',
		'add questions' => 'Add Questions',
		//-------------------------profile_modal
		'add job here' => 'Add Job Here',
		'industry' => 'Industry',
		'save changes' => 'Save changes',
		'add industry here' => 'Add Industry Here',
		'close' => 'Close',
		'add questions here' => 'Add Questions Here',
		'change your banner color here' => 'Change Your Banner Color Here',
		'your banner color' => 'Your Banner Color',
		'change logo image here' => 'Change Logo Image Here',
		'your logo image url' => 'Your Logo Image URL',
		
		//----------------
		'share video' => 'Share Video'
		);
		return $data;
	}
}
?>