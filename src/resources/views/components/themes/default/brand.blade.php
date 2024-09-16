@props([
    'image_url' => null
])

<tr>
    <td align="center"
        style="font-size:0px;padding:0px 25px;word-break:break-word;">

        <table align="center" border="0" cellpadding="0" cellspacing="0"
            role="presentation"
            style="border-collapse:collapse;border-spacing:0px;">
            <tbody>
                <tr>
                    <td style="width:64px;">

                        <img height="auto" src="{{$image_url ?? 'https://cdn.pixabay.com/photo/2013/07/12/12/57/red-146613_1280.png'}}"
                            style="border:0;display:block;outline:none;text-decoration:none;width:100%;"
                            width="64" />

                    </td>
                </tr>
            </tbody>
        </table>

    </td>
</tr>