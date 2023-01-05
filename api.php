<?php

namespace App;

use \Closure;
use \json_encode;
use \rand;
use \count;
use \date;
use \time;

$api = new Api($_SERVER['REQUEST_URI']);

$api->get("/news", function() {
    $news = Data::NEWS;
    $now = time();
    foreach($news as $key => $article) {
        $date = rand($now-(60*60*24*365),$now);
        $news[$key]["date"] = date("Y-m-d",$date);
        $news[$key]["time"] = date("H:i:s",$date);
        $news[$key]["author"] = Data::NAMES[rand(0,count(Data::NAMES)-1)];
        $news[$key]["category"] = Data::CATEGORIES[rand(0,count(Data::CATEGORIES)-1)];
    }
    Api::sendResponse($news);
});
$api->get("/randomfact", function() {
    Api::sendResponse(Data::FACTS[rand(0,count(Data::FACTS)-1)]);
});
$api->run();


class Api {

    private array $calls = [];

    public function __construct(private string $uri = "") { }

    public static function sendResponse(array $data) :void {
        if (!is_array($data)) {
            json_encode(["status"=>"error"]);
        }
        echo json_encode([
            "status" => "success",
            "data" => $data,
            "code" => 200
        ]);
        exit;
    }

    public function get(string $path, $fun) :void {
        $this->calls[$path] = $fun;
    }

    public function run() :void {
        foreach($this->calls as $path => $call) {
            if ($this->uri == $path && $call instanceof Closure) {
                $call(); 
            }
        }   
    }
}

class Data {

    const NEWS = [
        [
            "id" => 1,
            "title" => "Meta settles Cambridge Analytica scandal for $725m",
            "sumtitle" => "The proposed deal by Facebook's owner is the largest in a US data privacy class action, say lawyers.",
            "image" => "https://ichef.bbci.co.uk/news/820/cpsprodpb/1771/production/_128110060_gettyimages-1244572583.jpg"
        ],
        [
            "id" => 2,
            "title" => "Netflix password sharing against law - government",
            "sumtitle" => "The Intellectual Property Office said the practice might break criminal and civil law.",
            "image" => ""
        ],
        [
            "id" => 3,
            "title" => " GM unveils $30,000 electric SUV that will be one of the cheapest EVs available ",
            "sumtitle" => "",
            "image" => "https://media.cnn.com/api/v1/images/stellar/prod/220907211033-01-chevrolet-equinox-ev-090722.jpg?c=16x9&q=h_270,w_480,c_fill"
        ],
        [
            "id" => 4,
            "title" => "Apple and Tesla: Tech shares tumble amid supply issues",
            "sumtitle" => "Apple and Tesla stocks have tumbled over growing concerns about delays in their production lines in China.",
            "image" => "https://ichef.bbci.co.uk/news/800/cpsprodpb/16B9B/production/_128138039_gettyimages-1306394025.jpg"
        ],
        [
            "id" => 5,
            "title" => "Could a robot answer Prime Minister's Questions?",
            "sumtitle" => "A robot has given evidence in Parliament, an MP has used a chatbot to write a speech - what next?",
            "image" => "https://ichef.bbci.co.uk/live-experience/cps/480/cpsprodpb/107AC/production/_128100576_gettyimages-1085717468.jpg"
        ],
        [
            "id" => 6,
            "title" => "Independent shops positive ahead of Christmas",
            "sumtitle" => "Retail sales dropped in November but some retailer say this month had been good for them.",
            "image" => "https://ichef.bbci.co.uk/news/800/cpsprodpb/4c3c/live/fa2d38a0-8139-11ed-90a7-556e529f9f89.jpg"
        ],
        [
            "id" => 7,
            "title" => "If no one comes we close early, says pub",
            "sumtitle" => "Almost 90% of pubs are considering shorter opening hours over winter as bills rise, according to a new survey.",
            "image" => "https://ichef.bbci.co.uk/live-experience/cps/800/cpsprodpb/13ED2/production/_128081618_barnpub.jpg"
        ],
        [
            "id" => 8,
            "title" => "First pictures of King Charles banknotes revealed",
            "sumtitle" => "Notes featuring the King's portrait will enter circulation in mid-2024, says the Bank of England.",
            "image" => "https://ichef.bbci.co.uk/live-experience/cps/800/cpsprodpb/8A1B/production/_128055353_16_9notext.png"
        ],
        [
            "id" => 9,
            "title" => "We're not about getting loo roll quickly, says Etsy",
            "sumtitle" => "People are prepared to wait longer for handmade items, says the chief of the e-commerce firm.",
            "image" => "https://ichef.bbci.co.uk/live-experience/cps/800/cpsprodpb/290F/production/_128011501_gettyimages-1233951395.jpg"
        ],
        [
            "id" => 10,
            "title" => "Luxury is never out of style, says Wolford owner",
            "sumtitle" => "Lanvin Group hopes to be the first luxury giant to rise out of Asia.",
            "image" => "https://ichef.bbci.co.uk/live-experience/cps/800/cpsprodpb/64F3/production/_128034852_gettyimages-1355236520.jpg"
        ],
    ];

    const FACTS = [
        [
           "id"=>1,
            "title"=> "The word \"set\" has more definitions than any other word in the English language.",
        ],
        [
            "id"=>2,
            "title"=> "Tom Sawyer was the first novel written on a typewriter",
        ],
        [
            "id"=>3,
            "title"=> "This common everyday occurrence composed of 59% nitrogen, 21% hydrogen, and 9% dioxide is called a `fart`",
        ],
        [
            "id"=>4,
            "title"=> "Every time you lick a stamp, you consume 1/10 of a calorie",
        ],
        [
            "id"=>5,
            "title"=> "American Airlines saved $40,000 in 1987 by eliminating one olive from each salad served in first-class",
        ],
    ];

    const NAMES = [
        "Emma Pham","Bria Andrade","Deborah Gray","Phoenix Levine","Misael Bernard","Karter Kaiser","Irvin Bennett",
        "Luz Holder","Hunter Downs","Jay Giles","Lana Klein","June Shannon","Owen Dixon","Jaycee Hart","Litzy Wilson", 
    ];

    const CATEGORIES = [
        "Sport","Travel","Climate","World","Business","Tech","Science","Health","Weather","Culture",
    ];

}
?>