@props([
'button_text' => null,
'button_url' => null
])
<tr>
    <td align="center"
        style="font-size:0px;padding:0px 25px;word-break:break-word;">

        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
            style="border-collapse:separate;line-height:100%;">
            <tr>
                <td align="center" bgcolor="#2F67F6" role="presentation"
                    style="border:none;border-radius:3px;color:#ffffff;cursor:auto;padding:15px 25px;" valign="middle">
                    <a href="{{$button_url}}"
                        style="background:#2F67F6;color:#ffffff;font-family:'Helvetica Neue',Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
                        {{$button_text}}
                    </a>
                </td>
            </tr>
        </table>

    </td>
</tr>