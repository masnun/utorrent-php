# uTorrent PHP Client #

#### An easy to use PHP wrapper of the uTorrent WebGUI APIs ####

+ __Author:__ Abu Ashraf Masnun
+ __Email:__ masnun@gmail.com
+ __Web:__ http://masnun.com

#### How to use? ####

See code samples in the example.php file. The steps are somewhat like these:

(1) Construct a new API object

(2)	Set login Credentials

(3) Fetch the CSRF Token

(4) Make an API Call


#### Calling the APIs ####

All parameters to the API must be passed as associative arrays. So, when we want to list the torrents, we shall call the api with these params:

	array(
		"list" => 1
	)     
	
	
Similarly, to get files under a torrent the params array will be like:

		
	array(
		"action" => "getfiles",
		"hash" => [TORRENT HASH]
	)
	

In short, you can pass the different parts of original request url as key-value pairs as params. 

Check out the official docs: <a href="http://www.utorrent.com/community/developers/webapi">http://www.utorrent.com/community/developers/webapi</a> 

I hope to add more examples and methods to make direct api calls soon. 


 