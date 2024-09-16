@props([
'link_text' => null,
'link_url' => null
])
<tr>
    <td align="left" style="font-size:0px;padding:0px 25px;word-break:break-word;">

        <div
            style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:14px;line-height:20px;text-align:left;color:#525252;">
            <a href="{{$link_url}}" style="color:#2F67F6">{{$link_text}}</a>
        </div>

    </td>
</tr>