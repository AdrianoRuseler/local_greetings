<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     local_greetings
 * @category    string
 * @copyright   2024 Adriano Ruseler <adrianoruseler@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Saudações';
$string['greetinguser'] = 'Saudações, usuário padrão.';
$string['greetingloggedinuser'] = 'Saudações, logado {$a}.';
$string['greetingnotloggedinuser'] = 'Saudações, não logado {$a}.';

// Display greetings based on user's country.
$string['greetingusernull'] = 'Greetings, NULL user.';
$string['greetinguserptbr'] = 'Olá, {$a}.';
$string['greetinguserau'] = 'Hello, {$a}.';
$string['greetinguseren'] = 'Hello, {$a}.';
$string['greetinguseres'] = 'Hola, {$a}.';
$string['greetinguserfj'] = 'Bula, {$a}.';
$string['greetingusernz'] = 'Kia Ora, {$a}.';

// Create the form.
$string['yourmessage'] = 'Sua mensagem:';

// Display user details with greetings posts.
$string['postedby'] = 'Postado por {$a}.';

// Describe the two new capabilities.
$string['greetings:viewmessages'] = 'Ver mensagens no mural de saudações';
$string['greetings:postmessages'] = 'Poste uma nova mensagem no mural de Saudações';
$string['greetings:deleteanymessage'] = 'Deletar quaisquer mensagem no mural de Saudações';
$string['greetings:deletemymessage'] = 'Deletar minhas mensagems no mural de Saudações';

$string['messagecardbgcolor'] = 'Cor do cartão de mensagem';
$string['messagecardbgcolordesc'] = 'Cor de fundo do cartão de mensagem';

// Add option to edit post.
$string['editmessage'] = 'Editar mensagem';
$string['norecordfound'] = 'Nenhum registro encontrado!';
$string['cannoteditmessage'] = 'Você não pode editar esta mensagem';
