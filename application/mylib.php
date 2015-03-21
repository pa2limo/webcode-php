<?php
// send email with attachment
function mail_file( $to, $subject, $messagehtml, $from, $fileatt, $replyto="" ) {
        // handles mime type for better receiving
        $ext = strrchr( $fileatt , '.');
        $ftype = "";
        if ($ext == ".doc") $ftype = "application/msword";
        if ($ext == ".jpg") $ftype = "image/jpeg";
        if ($ext == ".gif") $ftype = "image/gif";
        if ($ext == ".zip") $ftype = "application/zip";
        if ($ext == ".pdf") $ftype = "application/pdf";
        if ($ftype=="") $ftype = "application/octet-stream";
         
        // read file into $data var
        $file = fopen($fileatt, "rb");
        $data = fread($file,  filesize( $fileatt ) );
        fclose($file);
 
        // split the file into chunks for attaching
        $content = chunk_split(base64_encode($data));
        $uid = md5(uniqid(time()));
 
        // build the headers for attachment and html
        $h = "From: $from\r\n";
        if ($replyto) $h .= "Reply-To: ".$replyto."\r\n";
        $h .= "MIME-Version: 1.0\r\n";
        $h .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
        $h .= "This is a multi-part message in MIME format.\r\n";
        $h .= "--".$uid."\r\n";
        $h .= "Content-type:text/html; charset=iso-8859-1\r\n";
        $h .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $h .= $messagehtml."\r\n\r\n";
        $h .= "--".$uid."\r\n";
        $h .= "Content-Type: ".$ftype."; name=\"".basename($fileatt)."\"\r\n";
        $h .= "Content-Transfer-Encoding: base64\r\n";
        $h .= "Content-Disposition: attachment; filename=\"".basename($fileatt)."\"\r\n\r\n";
        $h .= $content."\r\n\r\n";
        $h .= "--".$uid."--";
 
        // send mail
        return mail( $to, $subject, strip_tags($messagehtml), str_replace("\r\n","\n",$h) ) ;
    }
    
// SLUGGABLE
function create_slug($string){
   $slugger=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slugger;
// echo create_slug('does this thing work or not');
//returns 'does-this-thing-work-or-not'
}
// -------------------------------------------------------------
/*  Returns the first $wordsreturned out of $string.  If string
contains fewer words than $wordsreturned, the entire string
is returned.
*/
function shorten_string($string, $wordsreturned){
    $retval = $string;      //  Just in case of a problem
    $array = explode(" ", $string);

    if (count($array)<=$wordsreturned) {
        /*  Already short enough, return the whole thing */
        $retval = $string;
    }
    else {
        /*  Need to chop of some words*/
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array);
    }
return $retval;
}

function count_words($string) {
    // Return the number of words in a string.
    $string= str_replace("&#039;", "'", $string);
    $t= array(' ', "\t", '=', '+', '-', '*', '/', '\\', ',', '.', ';', ':', '[', ']', '{', '}', '(', ')', '<', '>', '&', '%', '$', '@', '#', '^', '!', '?', '~'); // separators
    $string= str_replace($t, " ", $string);
    $string= trim(preg_replace("/\s+/", " ", $string));
    $num= 0;
    if (my_strlen($string)>0) {
        $word_array= explode(" ", $string);
        $num= count($word_array);
    }
    return $num;
}

function get_words($string, $max, $offset = 0, $append_dots = true){ 
    $string= str_replace("&#039;", "'", $string);
    $string= trim(preg_replace("/\s+/", " ", $string));

    $words = explode(" ", $string); 
    return 
        ($append_dots && $offset > 0 ? " ... " : "") .  
        implode(" ", array_splice($words, $offset, $max)) .  
        ($append_dots && $max < count($words) ? " ... " : ""); 
        }

function cleanInput($input) {
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
    );
    $output = preg_replace($search, '', $input);
    return $output;
  }

function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
    // SANITIZE
    // $good_string = sanitize($bad_string);
    // $_POST = sanitize($_POST);
    // $_GET  = sanitize($_GET);  
}

// READ MORE LINK
//function to truncate text and show read more link  
function truncate($mytext,$link,$var,$id) {  
//Number of characters to show  
    $chars = 25;  
    $mytext = substr($mytext,0,$chars);  
    $mytext = substr($mytext,0,strrpos($mytext,' '));  
    $mytext = $mytext." <a href='$link?$var=$id'>read more...</a>";  
    return $mytext; 
}
// USAGE above
/*
$sql = "SELECT * FROM articles";  
$result = mysql_query($sql);  
while($row = mysql_fetch_array($result))  
    {  
    echo "\n";  
    echo truncate($row['article_text'],"article.php","article_id",$row['article_id']);  
    } 
}  
*/

//
function stringDomain($string){ 
    $d = explode('/',$string); 
    return str_replace('www.','',$d[2]); 
} 

// $URL = 'http://php.net/round'; 
// echo stringDomain($URL);  // prints: php.net 

//This snippet just reads the whole site in a string.
// echo file_get_contents('http://templatemonster.com/'); 

// loremipsum random generator 
function loremipsum($para = 3) { 
    $lipsumholder   =   array( 
"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a massa vel elit lacinia fringilla. Fusce suscipit congue arcu, ut lobortis sem pretium eu. Vestibulum est urna, porta at tristique non, sollicitudin et nisl. Mauris at rhoncus lectus. In auctor elementum arcu eget porttitor. Duis lacus erat, luctus id vulputate non, dignissim id tellus. Etiam suscipit blandit turpis, et porttitor elit placerat vitae. Cras id ligula dolor. Maecenas eget neque in nunc rutrum commodo id eget velit. Praesent condimentum libero fringilla ligula auctor et interdum augue blandit. Etiam eu nisi leo, vitae luctus diam. Suspendisse urna augue, molestie et pretium in, commodo ut turpis. Duis pulvinar vestibulum pulvinar. Vivamus gravida ultricies ornare. Phasellus sodales mauris sed turpis lacinia rhoncus iaculis velit ornare. Praesent interdum arcu id nulla porttitor rhoncus. Nam consectetur tincidunt purus, quis dapibus urna facilisis ac.</p>", 
"<p>Aenean aliquam euismod leo, quis fermentum magna posuere et. Mauris eu elit nisl, a vulputate sapien. Sed vel orci sit amet orci ullamcorper egestas et non erat. Praesent ac tortor non libero congue blandit. Proin vulputate felis ac ipsum ullamcorper fermentum. Vestibulum diam orci, fringilla non consectetur id, dapibus pharetra velit. Morbi tincidunt dui eget ante porta pretium. Cras ultrices aliquam ultrices. Nunc pharetra, dolor et dignissim dignissim, sapien elit consectetur nibh, blandit fringilla justo lacus at libero. Cras nec erat et neque commodo tempor. Vivamus dignissim faucibus velit, non tincidunt ligula ultricies quis. Morbi congue, justo a aliquam posuere, enim quam sagittis dolor, sed porta elit lorem id odio.</p>", 
"<p>Duis egestas mi eu neque porta feugiat. Aenean in ipsum orci. Proin varius dolor nisl, a fringilla ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus sem leo, fringilla id accumsan vestibulum, sagittis vitae justo. Vestibulum a massa sed nisi ultrices vulputate sed et libero. Proin ac lacus vel lorem ultricies dapibus id a dolor. Etiam ut lacus quis velit interdum egestas. Suspendisse ut tellus quis massa faucibus facilisis et sed mauris. Aenean vel congue sapien. Proin lorem massa, suscipit vitae placerat et, laoreet quis elit. Praesent sollicitudin volutpat sapien, sed rhoncus quam condimentum vitae. Curabitur luctus pretium tortor, vel cursus diam aliquam quis. Nunc egestas nulla et quam viverra tincidunt.</p>", 
"<p>Donec sapien arcu, suscipit eget sollicitudin id, cursus eget dolor. Pellentesque nibh sapien, blandit et feugiat sit amet, mattis vitae mi. Integer porttitor, magna ut laoreet hendrerit, erat leo laoreet enim, in viverra ante ligula a mi. Sed tellus nisl, viverra ac suscipit quis, viverra eu massa. Fusce iaculis auctor mollis. Phasellus eu consectetur felis. Vivamus lacus eros, commodo in egestas quis, pellentesque ut sem. Nam lacus sem, aliquam a vehicula in, aliquam nec est. Etiam pretium augue tristique urna condimentum et imperdiet justo lacinia. Praesent aliquam odio id dui elementum sagittis. Vestibulum accumsan aliquet eros, sodales tristique leo gravida ut.</p>", 
"<p>Donec sed dolor vel quam rhoncus viverra et at risus. Proin gravida ipsum id urna mattis sed egestas tellus ultricies. Nam a turpis sed lacus tempor volutpat. Aliquam placerat ipsum ac diam commodo semper quis vitae orci. Quisque urna odio, semper et porta et, lacinia nec lorem. Donec luctus mattis tellus, pretium tristique nibh blandit et. Integer eu tristique augue. Morbi feugiat hendrerit diam, in fermentum augue malesuada eu. Nullam vel tellus lacus. Proin ultrices libero tincidunt orci bibendum nec mattis lorem rhoncus.</p>", 
"<p>Nunc dolor tortor, fermentum eu tempor ut, lobortis eu elit. Phasellus tristique lacinia leo, id ultrices erat vehicula sit amet. Aenean pretium accumsan dui congue blandit. Donec arcu neque, posuere suscipit porttitor at, lacinia eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur cursus blandit felis, et semper nisi tempus ut. Sed vitae nisl lorem. Nullam vitae sodales magna. Sed feugiat leo id mauris varius id ullamcorper erat ultricies. Duis ullamcorper vestibulum sem, sed iaculis urna porta et. Nam sapien eros, convallis at vestibulum nec, sollicitudin et nunc. Mauris diam tortor, dapibus id accumsan iaculis, aliquam non lacus. Maecenas malesuada, magna sit amet pellentesque bibendum, lacus nisl condimentum urna, eget pellentesque dui sem id ipsum. Pellentesque blandit leo nec odio venenatis non elementum orci semper. Nam adipiscing magna consequat mauris vulputate condimentum. Aliquam eget mi nibh, at laoreet erat. Curabitur aliquam tincidunt metus, sed faucibus nibh ultricies at. Ut sit amet risus in nunc sagittis volutpat.</p>", 
"<p>Nulla blandit malesuada arcu at sollicitudin. Nulla aliquam gravida dictum. Vivamus ultricies blandit turpis, vitae ultricies velit interdum at. Suspendisse potenti. Proin lobortis mi id eros porta imperdiet. Integer cursus mauris a nulla hendrerit commodo. In eu dolor a eros egestas tempus at nec mauris. Suspendisse convallis suscipit dui sit amet feugiat. Nulla ultricies ligula erat, quis tristique enim. Nulla sed nisi urna, in rutrum nunc. Donec a urna dolor, et sagittis quam. Nullam luctus justo at justo lacinia aliquet. In malesuada velit id enim congue non congue sem congue. Quisque ac dapibus erat.</p>", 
"<p>Etiam gravida lectus id ipsum iaculis luctus id eu urna. Aliquam lacus ipsum, commodo dignissim fringilla nec, viverra sit amet neque. Phasellus placerat adipiscing vestibulum. Pellentesque volutpat scelerisque fringilla. Phasellus sed magna id odio euismod tincidunt a eget ante. Donec vel ligula odio. Etiam mattis urna vel lacus venenatis id pulvinar arcu commodo. Donec eget convallis enim. Nullam velit lacus, feugiat a consequat ac, posuere et odio. Phasellus egestas, nisl et interdum fringilla, nisl tortor pretium nulla, eget rutrum turpis ligula iaculis nunc. Suspendisse et iaculis eros. Aliquam in nulla ut purus volutpat mattis.</p>", 
"<p>Morbi blandit pretium facilisis. Mauris fringilla faucibus libero quis porta. Mauris leo dui, vestibulum eget molestie ut, ullamcorper eget ligula. Nulla ac mi nunc, quis laoreet nunc. Quisque viverra commodo turpis ut pharetra. Cras eget justo est, sed rutrum elit. In hac habitasse platea dictumst. Nunc risus lorem, faucibus non tempor nec, vehicula non nibh. Mauris interdum risus eu mauris luctus at porta quam iaculis. Vivamus tempor ante vitae nunc interdum at interdum lectus gravida. Vivamus fermentum enim ac lectus feugiat ut pharetra augue egestas. Duis suscipit, elit a semper egestas, odio purus rutrum dolor, vel aliquet tortor ligula vel metus.</p>", 
"<p>Etiam ut diam in ante suscipit porta. Duis blandit eleifend pulvinar. Maecenas id libero sit amet sapien venenatis accumsan. Fusce tempor augue quis sapien venenatis scelerisque. Maecenas est diam, viverra pulvinar pellentesque eu, vulputate lacinia mauris. Nunc ac dapibus justo. Praesent ac ante est, ac tempor lacus. In lobortis vulputate felis, vel placerat ligula fringilla at. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque tincidunt commodo varius. Ut dapibus mollis libero non egestas. Praesent vitae feugiat nibh. Sed orci odio, facilisis eget consequat quis, tincidunt ac nulla. Donec quis tortor sit amet orci posuere ornare. Donec non elit vitae lacus ornare sagittis. Aliquam erat volutpat. Vestibulum pellentesque nunc a mi suscipit dictum. Donec consectetur condimentum erat at auctor. Ut dapibus tincidunt nulla et placerat.</p>", 
"<p>Curabitur ac enim est, at aliquam mi. Mauris in enim est, id tristique dolor. Vivamus purus libero, tempus quis adipiscing et, dignissim sed libero. Mauris elit sem, pellentesque et suscipit vitae, sagittis nec purus. Nullam eu eros ante, vitae facilisis nulla. Proin ut pellentesque lorem. Fusce viverra feugiat massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tincidunt turpis id velit egestas vulputate. Mauris molestie sem id neque tincidunt vestibulum. Sed quis nibh ligula, id elementum ipsum. Vestibulum id sem at nisl tincidunt vulputate. In lobortis bibendum risus in aliquet. Pellentesque pulvinar lobortis tellus sit amet feugiat. In pellentesque consequat sollicitudin.</p>", 
"<p>In laoreet, lorem quis scelerisque condimentum, sapien arcu mattis nibh, et tincidunt ante ligula et tellus. Cras nulla purus, dapibus vel vestibulum vel, semper ut nunc. Quisque ullamcorper neque non urna rutrum ac imperdiet mauris facilisis. Ut in nunc libero. Mauris sem leo, pellentesque quis varius sit amet, porttitor vitae sapien. Maecenas mauris elit, feugiat quis elementum vitae, aliquet et diam. Proin tempor, nisi vel cursus dapibus, lacus lectus tristique augue, nec porttitor nisl arcu placerat elit. Mauris laoreet erat sit amet dolor laoreet id vestibulum nisi ornare. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse odio enim, ornare convallis dignissim nec, tempus quis quam. Mauris volutpat pretium lacus sit amet sollicitudin. Ut ut lorem elit. Fusce sit amet ligula magna. Curabitur consequat ornare sem ut consequat. Maecenas ut erat quis est tempus laoreet. Quisque viverra felis eget felis luctus vel rutrum mi gravida.</p>", 
"<p>Aliquam erat volutpat. Etiam quis quam odio. Duis egestas interdum pulvinar. Ut convallis vulputate sagittis. Phasellus blandit lacinia imperdiet. Cras imperdiet tortor ac arcu gravida mollis. Phasellus in diam enim, vitae posuere lectus. Integer et urna ac massa elementum commodo. Quisque eget metus dolor. Etiam consequat eros eu elit convallis egestas. Nam a erat nec erat commodo feugiat. Proin nec sagittis purus. Vestibulum et erat sit amet lacus ullamcorper faucibus.</p>", 
"<p>Vestibulum cursus purus eget nisi consequat ullamcorper. Nullam imperdiet congue egestas. Sed mi diam, commodo in malesuada in, facilisis ut ante. Maecenas laoreet dictum ultricies. Nullam mattis vulputate eros, sit amet mattis mi cursus vitae. Maecenas cursus luctus nisl, quis tincidunt purus ullamcorper non. Sed consequat egestas elementum. In tristique gravida justo et rutrum. Pellentesque mattis, orci sed venenatis sollicitudin, lectus diam elementum nisl, eu fermentum purus leo vitae nulla. Pellentesque varius consequat tellus. Mauris ultrices vehicula porta. Ut adipiscing lacus eget quam varius porta. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse erat augue, auctor a semper et, dictum eu eros. Cras mattis ultricies lorem. Sed placerat porttitor massa, at pharetra dui pellentesque a. Phasellus mollis adipiscing tincidunt. Etiam sollicitudin purus vel ante luctus a blandit justo consequat. Quisque dui ipsum, sodales eu placerat at, ornare in mi.</p>", 
"<p>Phasellus eleifend ultricies enim a suscipit. Aliquam tempor dictum pulvinar. Quisque tincidunt risus vitae diam fermentum et placerat sapien scelerisque. Aliquam non dui fermentum purus sodales vulputate. Proin at pulvinar est. Suspendisse potenti. Donec turpis justo, lobortis sed congue a, consectetur id quam. Nulla at nulla urna, vitae venenatis metus. Donec ut augue sed nisl pharetra euismod et in neque. Praesent augue elit, hendrerit vitae pulvinar quis, tempus ac nunc. Curabitur turpis nunc, faucibus hendrerit scelerisque sit amet, gravida non sem. Donec lobortis sodales ultrices. Maecenas pharetra ultricies mollis.</p>", 
"<p>Suspendisse potenti. Praesent vel nulla luctus nulla vulputate mollis hendrerit a felis. Nunc molestie justo blandit sem dictum nec faucibus erat vehicula. Aenean sed erat diam, eu scelerisque sem. Quisque a lacus eros, vel consectetur lacus. Nulla sit amet risus tellus. Suspendisse nisi sapien, placerat sed luctus nec, ultrices vel dolor. Vestibulum leo massa, mattis condimentum pharetra nec, posuere tincidunt nibh. Phasellus in lorem ac diam adipiscing luctus dapibus quis lorem. In vitae massa in lorem dictum sollicitudin ut et urna. Sed laoreet, risus in pharetra dapibus, nisl lorem fringilla tortor, vel dictum magna quam sit amet arcu. Nam eu iaculis nunc. Cras sed posuere diam. Integer ac eleifend nulla. Nullam aliquam tellus sit amet metus consectetur pretium pretium lectus convallis. Maecenas venenatis erat quis nibh eleifend semper vestibulum odio iaculis. Mauris eu massa vitae tellus condimentum malesuada quis ac dolor.</p>", 
"<p>Vivamus pulvinar sem et est feugiat sed iaculis dui congue. Vivamus eu risus vitae orci pellentesque luctus at et eros. Pellentesque et turpis dui, quis tempor ligula. Nullam vitae neque euismod tortor fringilla accumsan et rhoncus arcu. Mauris hendrerit dignissim commodo. Praesent adipiscing ipsum in massa convallis ullamcorper. Vivamus sed lacus tortor. Cras sed enim ut ligula dignissim dignissim sed id magna. Nam pulvinar varius mi, rutrum posuere ligula adipiscing sed. Suspendisse potenti. Nulla convallis neque ac nunc aliquam euismod. Aenean at velit et odio convallis consequat. Aliquam consequat feugiat turpis non eleifend. Maecenas fermentum, lectus vitae auctor consectetur, odio urna aliquam neque, at hendrerit leo nisl quis erat. Phasellus velit quam, iaculis et cursus at, pulvinar sed tortor.</p>", 
"<p>Nam at tempor purus. Donec sit amet nisl et urna accumsan mollis. Donec ac lorem tempor orci blandit fringilla vitae at libero. Fusce placerat cursus rutrum. Vivamus eget tortor luctus sapien molestie aliquet. Quisque nisi ligula, volutpat id ornare nec, ullamcorper a elit. Quisque eleifend lorem non sem porttitor ac posuere nisi viverra. Fusce pellentesque congue leo, quis dignissim lacus congue ac. Sed at congue leo. Aenean tincidunt, mauris id auctor malesuada, lorem nisl tincidunt neque, nec viverra magna magna vel libero. Nullam eu turpis purus. Vestibulum tristique commodo nisl vitae iaculis. In blandit hendrerit imperdiet. Proin et massa libero, at feugiat sapien. Vivamus commodo posuere purus, vel mollis eros bibendum sed. Maecenas quam lorem, luctus at feugiat sit amet, porta vel nulla. Fusce eu adipiscing erat. Suspendisse sodales nibh non lorem ultricies adipiscing.</p>", 
"<p>Quisque et risus odio, ac euismod felis. Morbi non magna metus. Nam purus massa, dictum non facilisis vel, commodo sed dui. Cras dapibus rhoncus arcu, placerat fringilla quam vestibulum vehicula. Sed rutrum dictum mauris, id eleifend erat iaculis non. Vestibulum non arcu arcu, eu cursus augue. Vestibulum ut ipsum augue, at condimentum metus. Curabitur aliquam eleifend nibh, vel eleifend metus vulputate quis. Nam mollis malesuada sapien, in molestie leo dictum non. Pellentesque tristique dolor quis leo eleifend a elementum ligula porta. Mauris et libero nunc. Praesent non varius justo. Donec posuere, purus nec aliquet dictum, lectus est semper diam, pharetra molestie eros enim at nunc. Curabitur nec mi magna. Aliquam id faucibus est. Suspendisse eget semper purus.</p>", 
"<p>Aenean tincidunt nibh vel enim laoreet vitae condimentum risus dignissim. Curabitur sit amet felis lacus, a pharetra dui. Curabitur in felis non nibh vehicula ultrices ac sed lorem. Suspendisse bibendum magna a nibh convallis at malesuada odio rhoncus. Sed nec volutpat dolor. Nullam lorem dui, ornare eget gravida a, ullamcorper vitae mi. Vivamus non urna quam, vel gravida odio. Etiam fermentum imperdiet lectus nec porta. Integer quam metus, feugiat volutpat convallis eget, tempor eget ipsum. Duis feugiat, nibh vel elementum tristique, est justo dignissim est, ac hendrerit quam ligula eu odio. Maecenas volutpat massa nec libero luctus tempus. Fusce vulputate turpis felis, tincidunt porttitor augue. Etiam non leo augue. Donec non elit nec ante scelerisque gravida nec non diam. Praesent id lorem dui, sed faucibus diam.</p>", 
"<p>Sed commodo interdum erat, non ultrices metus consequat at. Sed vestibulum eros a erat rhoncus suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent massa nunc, posuere sit amet aliquam non, hendrerit id tortor. Aenean eu tortor odio. Nulla et convallis sapien. Nam laoreet risus ut arcu scelerisque a blandit urna tristique. Vestibulum quis sem non lacus sagittis luctus a et turpis. Praesent molestie pharetra justo lobortis pretium. Proin aliquam quam non massa ultricies vehicula. Nam et eros nec ligula laoreet lacinia. Ut nec vehicula velit. Cras malesuada, leo et interdum porttitor, nunc neque porta nunc, ac placerat felis orci ac mi. Donec ultricies diam bibendum nunc mollis ut pellentesque odio bibendum. Fusce cursus sapien sit amet dolor faucibus at rhoncus lorem varius. In ut bibendum elit. Quisque pellentesque lorem ut est luctus nec imperdiet orci feugiat. Phasellus in elit dui, quis suscipit justo.</p>", 
"<p>Pellentesque a velit velit. Sed eu felis et ante sagittis placerat. Nulla in auctor tortor. Proin vitae enim non nibh sollicitudin tristique vel ut nisl. Sed sed elementum augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam ipsum magna, lacinia vel mollis eget, laoreet vitae enim. Nunc consequat tempus pellentesque. Phasellus odio sapien, vehicula non ultrices eleifend, volutpat quis nisi. Morbi in urna nisl. Sed tellus nulla, venenatis dapibus placerat id, fermentum eget ligula. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas a nunc lorem, vitae posuere ligula. In lobortis turpis vel eros cursus lacinia.</p>", 
"<p>Praesent tempor, nisi in tincidunt molestie, eros nunc elementum augue, id rutrum orci tellus nec risus. Duis in ultrices nisi. Suspendisse potenti. Sed egestas felis risus. Etiam vel tellus et nulla rutrum sollicitudin. Quisque ultrices tortor blandit dui pulvinar in porta leo adipiscing. Quisque eget tincidunt ante. Sed ultricies ligula nec ante ullamcorper aliquet accumsan turpis commodo. Fusce porta lectus vel dolor vehicula bibendum. Praesent ut iaculis magna. Nunc non sapien eros. Ut porttitor facilisis nulla ac consequat. Donec at aliquam dolor. Aenean pretium pharetra porta. Pellentesque nec quam in diam vestibulum suscipit ut eget dui. Suspendisse vel tortor enim. Duis quis tortor nec ipsum vestibulum adipiscing. Ut dolor tortor, mattis a adipiscing vitae, suscipit quis lacus.</p>", 
"<p>Integer nec neque vel dolor gravida scelerisque. Sed et nibh libero. Ut turpis quam, sodales nec accumsan nec, consequat eget diam. Pellentesque viverra, risus nec aliquet ultrices, velit dolor vehicula dui, id faucibus nunc enim tincidunt magna. Ut quis bibendum mauris. Phasellus ultricies bibendum augue, sit amet consequat diam volutpat ac. Ut varius sodales suscipit. Sed eu libero vel metus condimentum convallis. Aliquam erat volutpat. Maecenas tempor ullamcorper elementum. Curabitur sit amet nisi ante. Phasellus scelerisque odio vel libero hendrerit sed varius erat pellentesque. Integer porttitor, orci id auctor rhoncus, magna enim porttitor ligula, eu dignissim leo risus eu metus. Proin vitae dui imperdiet lectus pretium laoreet. Aliquam id eros sit amet sem adipiscing sodales. Nunc libero magna, commodo vehicula ullamcorper nec, vehicula non purus. Pellentesque diam mauris, mollis nec consectetur eget, commodo sit amet magna.</p>", 
"<p>Ut feugiat, urna eu condimentum lacinia, dui massa porta ante, eget egestas risus ligula nec quam. Aenean nec justo tortor. Nam id sem eu nisi tristique dictum eget nec elit. Proin consectetur iaculis leo, vel aliquet libero ultrices non. Duis consequat elementum libero, ut hendrerit ligula fringilla viverra. Pellentesque id nisl et arcu lacinia tincidunt elementum vel lectus. Donec enim odio, fringilla et sagittis quis, dapibus nec metus. Morbi id quam ut augue volutpat faucibus rutrum sit amet augue. Phasellus nunc ipsum, consectetur nec convallis in, varius nec lorem. Donec dapibus dictum posuere. Nullam in ante elit. Donec convallis velit non nibh malesuada blandit. Curabitur viverra consectetur euismod. Vivamus faucibus eros velit. Curabitur gravida tortor ut diam varius adipiscing.</p>", 
"<p>Maecenas aliquam lorem vitae velit consequat interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis lectus vitae mi accumsan venenatis. Integer eleifend dictum laoreet. Fusce sollicitudin tristique enim lacinia porta. Aliquam et placerat orci. In lobortis egestas congue. Phasellus ac sapien diam, quis sagittis justo. Aliquam commodo ante eu nibh posuere faucibus. Aliquam varius erat ac diam dignissim id dignissim risus adipiscing. Pellentesque aliquet vulputate eros ac lacinia. Nunc nunc neque, dapibus a consequat et, commodo at augue. Duis aliquet elementum iaculis. Mauris pellentesque placerat purus. Maecenas mattis ullamcorper pharetra. Morbi sed nisi nulla.</p>", 
"<p>Proin id nisl dignissim urna semper commodo vitae a eros. Nam a felis lorem. Curabitur condimentum lobortis metus, vitae sagittis diam feugiat vitae. Pellentesque luctus pulvinar vulputate. Donec nulla nunc, laoreet at sodales id, imperdiet ac arcu. Nullam condimentum mollis orci, ac gravida leo mollis sit amet. Morbi scelerisque accumsan sapien, ut rutrum risus rhoncus a. Maecenas ac enim id dolor eleifend congue. Suspendisse ligula risus, vehicula et iaculis vitae, tempus eu orci. Phasellus dapibus leo in ipsum cursus nec mattis mi lacinia. Nullam cursus lectus nulla. Phasellus non magna vitae tortor vestibulum dapibus nec nec magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum molestie augue a eros vehicula nec tincidunt nisi accumsan.</p>", 
"<p>Sed aliquet, ipsum ac tempus pellentesque, lectus nibh lacinia purus, in congue quam sapien quis orci. Phasellus bibendum neque et elit porttitor auctor ultricies felis luctus. Aliquam fermentum, elit vel aliquam venenatis, lacus eros cursus ligula, id gravida turpis ligula vitae arcu. Proin faucibus magna vitae est fermentum eget aliquam felis sagittis. Suspendisse potenti. Cras vehicula viverra lacus, ac tempus erat sollicitudin in. Proin arcu ipsum, tincidunt sit amet adipiscing tincidunt, porttitor quis eros. Phasellus nec faucibus orci. Aenean scelerisque leo vitae quam tristique ultrices accumsan metus consequat. Nunc ut ante a eros ullamcorper egestas. Quisque tincidunt porttitor risus at commodo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus eu leo tellus. Nullam at leo arcu. Cras mollis faucibus sollicitudin. Mauris consequat, massa sit amet sollicitudin lobortis, enim quam posuere lectus, in semper erat dolor quis sapien. Sed enim mi, blandit ut congue at, porta vitae purus. Maecenas id nisl tortor.</p>" 
); 
    for ($i = 0; $i < $para; $i++) { 
        echo $lipsumholder[rand(0,27)]; 
    } 
} 
// Basic Usage echo loremipsum(5);  will generate 5 Pargraph

function get_catname($cat_id){  
$cat=array('','PHP-Basic', 
              'PHP-OOP', 
              'PHP-Framework', 
              'PHP-Security', 
              'Best-Practices', 
              'Scaling-Webapp',
              'Web-Server', 
              'Bootstrap', 
              'HTML-CSS', 
              'JQuery');

switch ($cat_id) 
    {
       case 1:
           $cat_name= $cat[1];
           break;
       case 2:
           $cat_name= $cat[2];
           break;
       case 3:
           $cat_name= $cat[3];
           break;
       case 4:
           $cat_name= $cat[4];
           break;
       case 5:
           $cat_name= $cat[5];
           break;
       case 6:
           $cat_name= $cat[6];
           break;
       case 7:
           $cat_name= $cat[7];
           break;
       case 8:
           $cat_name= $cat[8];
           break;
       case 9:
           $cat_name= $cat[9];
           break;
       case 10:
           $cat_name= $cat[10];
           break;
    }
    return $cat_name;
}

function pagination($item_count, $limit, $cur_page, $link)
{
       $page_count = ceil($item_count/$limit);
       $current_range = array(($cur_page-2 < 1 ? 1 : $cur_page-2), 
                             ($cur_page+2 > $page_count ? $page_count : $cur_page+2));

       // First and Last pages
       $first_page = $cur_page > 3 ? '<a href="'.sprintf($link, '1').'">1</a>'.($cur_page < 5 ? ', ' : ' ... ') : null;
       $last_page = $cur_page < $page_count-2 ? ($cur_page > $page_count-4 ? ', ' : ' ... ').'<a href="'.sprintf($link, $page_count).'">'.$page_count.'</a>' : null;

       // Previous and next page
       $previous_page = $cur_page > 1 ? '<a href="'.sprintf($link, ($cur_page-1)).'">Previous</a> | ' : null;
       $next_page = $cur_page < $page_count ? ' | <a href="'.sprintf($link, ($cur_page+1)).'">Next</a>' : null;

       // Display pages that are in range
       for ($x=$current_range[0];$x <= $current_range[1]; ++$x)
               $pages[] = '<a href="'.sprintf($link, $x).'">'.($x == $cur_page ? '<strong>'.$x.'</strong>' : $x).'</a>';

       if ($page_count > 1)
               return '<p class="pagination"><strong>Pages:</strong> '.$previous_page.$first_page.implode(', ', $pages).$last_page.$next_page.'</p>';
}
