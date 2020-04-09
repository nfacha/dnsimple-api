##### This class is used to manage (list,create and delete) DNS records on dnsimple.com using its API.

You will need obtain your AccountID and API Key to use this library, you can do so from the "**Account**" option of the dashboard then head over to the "**Automation**" tab.

###### Usage:

```php
 $dnSimple    = new dnSimpleApi( "DNSIMPLE_API_KEY", "DNSIMPLE_ACCOUND_ID" );
 $dnsResponse = $dnSimple->createRecord( "example.com", [
     'type'    => 'a',
     'name'    => 'squirrel',
     'content' => '8.8.8.8'
 ] );
 if ( array_key_exists( 'data', $dnsResponse ) && array_key_exists( 'id', $dnsResponse['data'] ) ) {
     $dnSimple->deleteRecord( "example.com", $dnsResponse['data']['id'] );
 };

```

Official docs available here: https://dnsimple.com/api