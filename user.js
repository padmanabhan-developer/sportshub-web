var express = require('express');
var router = express.Router();


var User = require('../models/User.js');
var UserLogin = require('../models/UserLogin.js');
var UserChatName = require('../models/UserChatName.js');
var UserChatWord = require('../models/UserChatWord.js');
var Zone = require('../models/Zone.js');
var ChatSession = require('../models/ChatSession.js');

/* GET /user listing. */
router.get('/', function(req, res, next) {
  User.find()
      .exec(function (err, user) {
    if (err) return next(err);
    res.json(user);
  });
});

/* POST /user */
router.post('/', function(req, res, next) {
  User.create(req.body, function (err, post) {
    if (err) return next(err);
    res.json(post);
  });
});

/* POST /user/forgotpassword */
router.post('/forgotpassword/', function(req, res, next) {

  if( !req.body.username )
    res.json({
                  status : 'failed',
                  message : 'Value for username not found'
                });
  else if( !req.body.phonenumber )
    res.json({
                  status : 'failed',
                  message : 'Value for phonenumber not found'
                });

  User.findOne({username:req.body.username}, function (err, user) {

    if( user && !err ){

      if( user.phonenumber == req.body.phonenumber ){

          var crypto = require('crypto');
          user.password = crypto.randomBytes(8).toString('base64');

          user.save(function(err){

            if (err) return next(err);

              res.json({
                  status : 'success',
                  password : user.password
                });          
            });
        }
        else{
          res.json({
                  status : 'failed',
                  password : 'Invalid Phone Number'
                });  
        }

    }
    else{
      res.json({
                  status : 'failed',
                  message : 'Invalid User Name'
                });
    }

  });
});


/* POST /user/resetpassword */
router.post('/resetpassword/', function(req, res, next) {

  if( !req.body.user_key )
    res.json({
                  status : 'failed',
                  message : 'Value for user_key not found'
                });
  else if( !req.body.old_password )
    res.json({
                  status : 'failed',
                  message : 'Value for old_password not found'
                });
  else if( !req.body.new_password )
    res.json({
                  status : 'failed',
                  message : 'Value for new_password not found'
                });

  User.findById(req.body.user_key, function (err, user) {

    if( user && !err ){

      if( user.password == req.body.old_password &&  req.body.old_password != req.body.new_password ){
          user.password = req.body.new_password;

          user.save(function(err){

            if (err) return next(err);

            res.json(user);  
          });
          

        }
      else{
        res.json({
                  status : 'failed',
                  message : 'Invalid password'
                });

        }


    }
    else{
      res.json({
                  status : 'failed',
                  message : 'Invalid User Id'
                });
    }

  });
});

/* POST /user/setpinglimit */
router.post('/setpinglimit/', function(req, res, next) {

  if( !req.body.user_key )
    res.json({
                  status : 'failed',
                  message : 'Value for user_key not found'
                });
  else if( !req.body.ping_limit )
    res.json({
                  status : 'failed',
                  message : 'Value for ping_limit not found'
                });

  User.findById(req.body.user_key, function (err, user) {

    if( user && !err ){

          user.pinglimit = req.body.ping_limit;

          user.save(function(err){

            if (err) return next(err);

            res.json(user);  
          });

    }
    else{
      res.json({
                  status : 'failed',
                  message : 'Invalid User Id'
                });
    }

  });
});

/* POST /user/deactivate */
router.post('/deactivate/', function(req, res, next) {

  if( !req.body.user_key )
    res.json({
                  status : 'failed',
                  message : 'Value for user_key not found'
                });

  User.findById(req.body.user_key, function (err, user) {

    if( user && !err ){

          user.isactive = false;

          user.save(function(err){

            if (err) return next(err);

            res.json(user);  
          });

    }
    else{
      res.json({
                  status : 'failed',
                  message : 'Invalid User Id'
                });
    }

  });
});

/* GET /user/id */
router.get('/:id', function(req, res, next) {
  
  var user = User.findById(req.params.id)
                  .exec(function (err, user) {
    if (err) return next(err);

    if( user ){

      console.log(user);
      
      res.json(user);

    }
  });

});

/* PUT /user/:id */
router.put('/:id', function(req, res, next) {
  User.findByIdAndUpdate(req.params.id, req.body, function (err, post) {
    if (err) return next(err);
    res.json(post);
  });
});

/* DELETE /user/:id */
router.delete('/:id', function(req, res, next) {
  User.findByIdAndRemove(req.params.id, req.body, function (err, post) {
    if (err) return next(err);
    res.json(post);
  });
});


// Following are the methods for Chat Name
 
 // GET /user/chatname listing. 
router.get('/picture/:picture_key', function(req, res, next) {
  //Checking if the user ID is valid
  
  if( req.params.picture_key ){
    //TODO: Get picture object from S3 and return
      var params = {
                      Bucket: 'alienster-bucket-1',
                      Key: 'test_folder/'+req.params.picture_key,
                      ResponseContentType: 'image/jpeg'
                    };

      s3.getObject(params, function(err, data) {

          if (err){
            console.log(err, err.stack); // an error occurred
            res.json(data);
            // res.writeHead(404,{'Content-Type': 'image/jpeg'});
            // res.end( null );
          } 
          else{

            //var dat = new Buffer(data.Body , 'utf8' );
            //console.log( dat.isEncoding('utf8') );           // successful response
            res.writeHead(200,{'Content-Type': 'image/jpeg'});
            res.end( data.Body );
            //res.write(data.body);
            //res.json(data.Body);
            //Structure
            // {
            //   "AcceptRanges":"bytes",
            //   "LastModified":"Thu, 21 May 2015 19:06:34 GMT",
            //   "ContentLength":"62613",
            //   "ETag":"\"cb372db472a98004c6ae577e158f6cda\"",
            //   "ContentType":"image/jpg",
            //   "Metadata":{},
            //   "Body":[]
            // }
          }
          

      });

  }
  else{
    res.writeHead(404,{'Content-Type': 'image/jpeg'});
    res.end( null );
  }
      
});

// GET /user/chatname listing. 
router.get('/rawpicture/:user_key', function(req, res, next) {
    var fs = require("fs");
    var filename = "./images/CC_Eins.jpg";

        fs.readFile( filename, function(err, picture_data) {
          if (err) return next(err);

            //console.log( "Picture Data : " + picture_data.toString() );
              // successful response
              //console.log(picture_data);
              res.writeHead(200,{'Content-Type': 'image/jpeg'});
              res.end( picture_data );

            });
});

// POST /user/chatname 
router.post('/picture/', function(req, res, next) {
   //Checking if the user ID is valid


  var formidable = require('formidable');
  var form = new formidable.IncomingForm();

  // form.parse analyzes the incoming stream data, picking apart the different fields and files for you.

  form.parse(req, function(err, fields, files) {

    var user_key = fields.user_key;

    if( !user_key )
      user_key = files.user_key;

    console.log( "User_key : " + user_key);

    if( user_key ){

        User.findById( user_key , function (err, user) {
        
          if (err) return next(err);
          //res.json(post);

          if( user ){

            var picture_name = user.picture;
            
            if( !picture_name ){
              var crypto = require('crypto');
              picture_name = crypto.randomBytes(16).toString('hex');
              
            }

            var picture_data = fields.picture;

            if( !picture_data )
              picture_data = files.picture;

            console.log( "Type of Picture : " + typeof(picture_data) );

            if( picture_data ){

              console.log( "Type of Picture : " + JSON.stringify(picture_data) );

             // picture_data = picture_data.toString();
              //picture_data = new Buffer(picture_data, 'base64');

              //res.writeHead(200,{'Content-Type': 'image/jpeg'});
              //res.end( picture_data );

              //return false;
                
                var fs = require("fs");
                var filename = picture_data.path;//"./images/CC_Eins.jpg";


                var photoDir = __dirname+"/../uploads/profiles/";
                var thumbnailsDir = __dirname+"/photos/thumbnails/";
                var photoName = picture_data.name;

                console.log( "Dir name : " + photoDir );
                console.log( "Photo name : " + photoName );

                fs.rename(
                          filename,
                          photoDir+photoName,
                          function(err){
                            if(err != null){
                              console.log(err)
                              res.send({error:"Server Writting No Good"});
                            } else {
                                

                            fs.readFile(photoDir+'/'+photoName , function(err, picture) {
                              
                              if( err ){

                                console.log( "Error : " + JSON.stringify(err) );
                                return next(err);
                              } 
                
                                      var params = {
                                        ACL:"public-read",
                                        Bucket: 'alienster-bucket-1',
                                        Key: 'test_folder/'+picture_name,//CC_Eins.jpg',
                                        Body: picture,
                                        ContentType: 'image/jpeg',
                                      };

                                      s3.putObject(params, function(err, data) {

                                        if (err){
                                          console.log(err, err.stack); // an error occurred
                                          return next(err);
                                        }

                                        user.picture = picture_name;
                                        user.save();
                                        
                                        data["picture_name"] = picture_name;
                                        console.log(data);           // successful response
                                        res.json(data);

                                        //Structure
                                        // {
                                        //     "ETag": "\"cb372db472a98004c6ae577e158f6cda\""
                                        // }


                                      });
                                });
                   }
              });
                

            }
            else{
              console.log( "Picture data not found");

              res.json({
                  status : 'failed',
                  message : 'Picture data not found'
                });
            }
           
          }
          else{
                console.log( "value for user_key is invalid" );

              res.json({
                    status : 'failed',
                    message : 'value for user_key is invalid'
                  });
          }

        });

    }
    else{
                console.log( "value for user_key not found");

              res.json({
                    status : 'failed',
                    message : 'value for user_key not found'
                  });
    }

  });
  
  
});

// POST User Login
router.post('/login/', function(req, res, next) {
  if( req.body.username && req.body.password ){
    User.findOne( req.body , function(err, user){
    
    	if( user ){
    		var data = {
        		user_key : user.id
      			};
      
      		UserLogin.create( data , function (err, login) {
        	  if (err) return next(err);
              res.json({
                        status:"success",
                        session_key: login.id,
                        user_key : login.user_key
                      });        	
            });
    	}
    	else
    		res.json({status:"failed",message:"Invalid Credentials"});
      
    });
  }else{
    res.json({status:"failed",message:"Invalid Credentials"});
  }
  
});

// POST User Login
router.post('/logout/', function(req, res, next) {
  if( req.body.user_key && req.body.session_key ){

    UserLogin.findById( req.body.session_key , function(err, login){
    
      if( login && login.user_key == req.body.user_key ){

          login.logged_out_at = Date.now();
      
          login.save( function (err ) {
            if (err) return next(err);

              res.json({status:"success",message:"Succesfully Logged Out"});

          });
      }
      else
        res.json({status:"failed",message:"Invalid Session or User Key"});
      
    });

  }else{
    res.json({status:"failed",message:"Value for Session or User Key not found"});
  }
  
});


// Following are the methods for Chat Name
 
 // GET /user/chatname listing. 
router.get('/chatname/:user_key', function(req, res, next) {
  //Checking if the user ID is valid
  
  User.findById(req.params.user_key)
      .exec(function (err, user) {
    
    if (err) return next(err);
    res.json( user.chatname );

  });
});

// POST /user/chatname 
router.post('/chatname/', function(req, res, next) {
   //Checking if the user ID is valid

  if( req.body.user_key && req.body.chat_name ){
      User.findById( req.body.user_key , function (err, user) {
      
        if (err) return next(err);
        //res.json(post);

        if( user ){
              //If User is Valid , Format and Insert Chatname for the user
              UserChatName.create(req.body, function (err, chatname) {
                if (err) return next(err);

                if( chatname ){

                  user.chatname = chatname.chat_name;
                  user.save();

                  res.json(chatname);
                }
                else{
                  res.json({
                      status : 'failed',
                      message : 'error occurred , try again later'
                    });
              }
          });
        }
        else{
            res.json({
                  status : 'failed',
                  message : 'value for user_key is invalid'
                });
        }
        

      });
  }
  else{
    if( !req.body.user_key ){

        res.json({
              status : 'failed',
              message : 'value for user_key is not found'
            });

      }else if( !req.body.chat_name ){

        res.json({
              status : 'failed',
              message : 'value for chat_name is not found'
            });

      }
  }
  
  
});

// Following are the methods for Chat Word

// GET /user/chatword listing. 
router.get('/chatword/:user_key', function(req, res, next) {
  //Checking if the user ID is valid
  
  User.findById(req.params.user_key)
      .exec(function (err, user) {
    
    if (err) return next(err);
    res.json( user.chatword );

  });

});

// GET /user/searchbyword listing. 
router.get('/searchbyword/:user_key/:chat_word/:chat_name/:skip/:limit', function(req, res, next) {
  //Checking if the user ID is valid

  console.log("User key : " , req.params.user_key);
  console.log("Chat word : " , req.params.chat_word);
  console.log("Chat name : " , req.params.chat_name);

  var _skip = req.params.skip;
  var _limit = req.params.limit;

  if( !_skip )
    _skip = 0;

  if( !_limit )
    _limit = 0;

  if( req.params.user_key && req.params.chat_word && req.params.chat_name ){

    User.findById(req.params.user_key)
      .exec(function (err, user) {
          //If error retrieving user by id
          if (err) return next(err);
          
          if( user ){

            User.find({chatword: new RegExp(req.params.chat_word, "i") , _id:{ $ne: req.params.user_key } })
                  .select("id")
                  .sort({ chatword: 'asc'})
                  .skip(_skip)
                  .limit(_limit)
                  .exec( function (err, user_keys) {
            //If error retrieving chat word by id
            if (err) return next(err);

            console.log( user_keys );


            var keys = [];
            for (i = 0; i < user_keys.length; i++) {

              if( keys.indexOf(user_keys[i].id) < 0)
                keys.push( user_keys[i].id );
            }

            console.log( keys );

            if( keys ){

                User.find( { _id:{ $in: keys } })
                .exec( function(err , users ){

                    console.log( "Users : " + users );

                      //UserChatWord.create( req.params );
                      //UserChatName.create( req.params );
                      //Saving ChatName
                      UserChatName.create(req.params , function(err , chatname){
                        user.chatname = chatname.chat_name;
                        user.save();
                      });

                      UserChatWord.create(req.params , function(err , chatword){
                        user.chatword = chatword.chat_word;
                        user.save();
                      });

                    //Returning the search results
                    res.json(users);
                });
          }
          else{
            res.json({
                  status : 'failed',
                  message : 'no result found'
                });
          }

        });
    

      }
      else{
        res.json({
                status : 'failed',
                message : 'value for user_key is invalid'
              });
      }

      
    
    });

  }
  else{
      if( !req.params.user_key){
        res.json({
                status : 'failed',
                message : 'value for user_key not found'
              });
      }

      if( !req.params.chat_word ){
        res.json({
                status : 'failed',
                message : 'value for chat_word not found'
              });
      }

      if( !req.params.chat_name ){
        res.json({
                status : 'failed',
                message : 'value for chat_name not found'
              });
      }

  }
  
});

// POST /user/chatword 
router.post('/chatword/', function(req, res, next) {
  //Checking if the user ID is valid
  console.log("User key : " , req.body.user_key);

  if( req.body.user_key && req.body.chat_word){
      User.findById( req.body.user_key , function (err, user) {
      
        if (err) return next(err);
        //res.json(post);

        if( user ){
              //If User is Valid , Format and Insert Chatword for the user
              UserChatWord.create(req.body, function (err, chatword) {
                if (err) return next(err);

                if( chatword ){

                  user.chatword = chatword.chat_word;
                  user.save();

                  res.json(chatword);
                }
                else{
                  res.json({
                      status : 'failed',
                      message : 'error occurred , try again later'
                    });
                }
          });
        }
        else{
            res.json({
                  status : 'failed',
                  message : 'value for user_key is invalid'
                });

          }
        });
    
  }
  else{
    if( !req.body.user_key ){

        res.json({
              status : 'failed',
              message : 'value for user_key is not found'
            });

      }else if( !req.body.chat_word ){

        res.json({
              status : 'failed',
              message : 'value for chat_word is not found'
            });

      }
  }
  
  
  
  
});

// POST /user/sendchatrequest
/*
	Params
	user_key
	to_user_key
*/ 
router.post('/sendchatrequest/', function(req, res, next) {
  //Checking if the user ID is valid
  User.find({_id: req.body.user_key } , function (err, user) {
    
    if (err) return next(err);
    //res.json(post);

    ChatSession.count( { $or: { user1_key:req.body.to_user_key , user2_key:req.body.to_user_key } , status: "opened" } , function( err , count ){

      console.log( "Total number of Chats Open : " , req.body);
      console.log( "Total number of Chats Open : " , count);
    	if( !count || count < 5 ){
	    		ChatSession.findOne( {user1_key:req.body.user_key, user2_key: req.body.to_user_key} ).sort( {created_on:-1} ).exec( function( err , chatSession ){
  		    	if (err) return next(err);
  				
  				  var data = {
  				    		user1 : req.body.user_key,
  				    		user2 : req.body.to_user_key
  		    	};

  		    	if( !chatSession || chatSession.status == 'closed' || chatSession.user2_status == 'declined' ){
  		    		//res.json({status:'success'});
                    console.log( "chatSession : " , chatSession);

  		    		//If User is Valid , Format and Insert Chatname for the user
  			    	ChatSession.create(data , function (err, chatword) {
  			      		if (err) return next(err);
                        console.log( "chatword : " , chatword);

  			      		res.json(chatword);
  			    	});
  		    	}
  		    	else{

  		    		if( chatSession.status == 'waiting' )
  		    			res.json({status:'failed' , message: 'Already sent a request and waiting approval'});
  		    		else if( chatSession.user2_status == 'joined' )
  		    			res.json({status:'failed' , message: 'You are already chatting with this person'});
  		    		else
  		    			res.json({status:'failed' , message: 'Unknown error occurred, Close any opened chat to start new'});
  		    	}

  		    });
      	}
      	else{
      		res.json({status:'failed' , message: 'He/She has reached maximum chat limit'});
      	}

    });

  });
  
});

module.exports = router;