<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Event / Listener Mapping
     |--------------------------------------------------------------------------
     |
     | An event must be explictly listened to by a listener in order for that
     | listener to be able to handle its event. You can register events &
     | listeners by mapping events to their respective listeners below.
     |
     */

	'listeners' => [

		// When a user registers...
		Illuminate\Auth\Events\Registered::class => [

			// Send an email verification notification
			Illuminate\Auth\Listeners\SendEmailVerificationNotification::class

		]

	],

    /*
     |--------------------------------------------------------------------------
     | Subscribers
     |--------------------------------------------------------------------------
     |
     | Sometimes it may be useful to listen to multiple events and handle them
     | within a single class. This can be done using subscribers. All you
     | need to do is list the subscribers, and they will do the rest.
     |
     */

	'subscribers' => [

		//

	]

];