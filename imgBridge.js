/**
 *
 *  Put the code into Express routers.
 *  Before , You should install the module "superagent" .
 *
 *  By 44886.com
 */



res.writeHead(200, {
    'Content-Type': 'image/*'
});
let url = req.query.url;
if (!url) {
    res.send("");
    return false;
}
superagent.get(req.query.url)
    .set('Referer', '')
    .set("User-Agent",
        'User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36 Core/1.47.933.400 QQBrowser/9.4.8699.400'
    )
    .end(function(err, result) {
        if (err) {
            //res.send(err);
            return false;
        }
        res.end(result.body);
        return;
    });
