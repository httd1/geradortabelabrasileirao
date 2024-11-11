<?php

$dados_times = json_decode(file_get_contents('https://ft-oscore.opera-api.com/tournament/table?product=sports_h5&team_id=14496&lang=pt'), true);

$img_base = __DIR__ . '/base/png/base.png';
$img_font_bold = __DIR__ . '/base/fonts/LeagueSpartan-Bold.ttf';
$img_font_light = __DIR__ . '/base/fonts/LeagueSpartan-Light.ttf';

// coordenada inicial para o número da rodada
$eixo_x_rodada = 650;
$eixo_y_rodada = 50;

// coordenada inicial para cada item
$eixo_x_nome_time = 280;
$eixo_y_nome_time = 115;

// coordenada pontos
$eixo_x_pontos_time = 725;
$eixo_y_pontos_time = 115;

// coordenada jogos disputados
$eixo_x_jogos_time = 802;
$eixo_y_jogos_time = 115;

// coordenada vitórias
$eixo_x_vitorias_time = 868;
$eixo_y_vitorias_time = 115;

// coordenada saldo de gols
$eixo_x_saldo_gols_time = 930;
$eixo_y_saldo_gols_time = 115;

// imagem base
$png = imagecreatefrompng($img_base);

imagealphablending ($png, true);
imagesavealpha ($png, true);

$cor_texto = imagecolorallocate ($png, 0, 191, 99);

// desenha número da rodada
imagettftext ($png, 20, 0, $eixo_x_rodada, $eixo_y_rodada, 16777215, $img_font_bold, "37°");

// passa por todos os times da tabela
foreach ($dados_times['groups'][0]['all'] as $time) {

    $nome_time = ucwords($time['team_name']);
    $saldo_gols = ($time['goals_for'] - $time['goals_against']);
    $pontos = $time['points'];
    $jogos = $time['played'];
    $vitorias = $time['wins'];

    // desenha nome dos times
    imagettftext($png, 20, 0, $eixo_x_nome_time, $eixo_y_nome_time, $cor_texto, $img_font_bold, $nome_time);

    // desenha pontos dos times
    imagettftext($png, 20, 0, $eixo_x_pontos_time, $eixo_y_pontos_time, $cor_texto, $img_font_bold, $pontos);

    // desenha jogos dos times
    imagettftext($png, 20, 0, $eixo_x_jogos_time, $eixo_y_jogos_time, $cor_texto, $img_font_light, $jogos);

    // desenha vitórias dos times
    imagettftext($png, 20, 0, $eixo_x_vitorias_time, $eixo_y_vitorias_time, $cor_texto, $img_font_light, $vitorias);

    // desenha saldo de gols dos times
    imagettftext($png, 20, 0, $eixo_x_saldo_gols_time, $eixo_y_saldo_gols_time, $cor_texto, $img_font_light, $saldo_gols);

    // incrementa eixo Y nome do time
    // incrementa eixo Y pontos do time
    // incrementa eixo Y jogos do time
    // incrementa eixo Y vitórias do time
    // incrementa eixo Y saldo de gols do time
    $eixo_y_nome_time = $eixo_y_pontos_time = $eixo_y_jogos_time = $eixo_y_vitorias_time = $eixo_y_saldo_gols_time += 58;
}

imagepng($png, './tabela.png');
imagedestroy($png);