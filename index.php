<?php

class Gif
{
    private array $baseAPI = [
        'ok' => false,
        'status' => 400,
        'result' => []
    ];

    private array $links = [
        'gif_1' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=burn-in-anim-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=joycards",
        'gif_2' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=glitter-anim-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=firestarter",
        'gif_3' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=whirl-anim-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=bullpen+3d",
        'gif_4' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=shake-anim-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=old+stamper",
        'gif_5' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=shake-anim-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=kinkie",
        'gif_6' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=alien-glow-anim-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=sf+gushing+meadow",
        'gif_7' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=alien-glow-anim-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=pistoleer",
        'gif_8' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=flaming-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=pistoleer+3d",
        'gif_9' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=highlight-anim-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=bullpen+3d",
        'gif_10' => "https://www.flamingtext.com/net-fu/proxy_form.cgi?imageoutput=true&script=highlight-anim-logo&text=%s&doScale=true&scaleWidth=240&scaleHeight=120&fontname=blackchancery"
    ];

    public function __construct()
    {
        if (! isset($_REQUEST['text'])) {
            http_response_code(400);
            unset($this->baseAPI['result']);
            $this->baseAPI['error'] = "parameters not send";
            $this->baseAPI['info'] = "لطفا متن خود را با پارامتر 'text' ارسال نمائید.";
        }
        elseif ($_REQUEST['text'] == '') {
            http_response_code(400);
            unset($this->baseAPI['result']);
            $this->baseAPI['error'] = "empty value";
            $this->baseAPI['info'] = "مقدار 'text' را خالی نفرستید.";
        }
        else {
            http_response_code(200);
            $this->baseAPI['ok'] = true;
            $this->baseAPI['status'] = 200;
            foreach ($this->links as $key => $link) {
                $this->links[$key] = sprintf($link, $_REQUEST['text']);
            }
            $this->baseAPI['result'] = $this->links;
        }
    }

    public function __toString(): string
    {
        header("Content-Type: application/json");
        return json_encode($this->baseAPI);
    }
}
echo new Gif;
