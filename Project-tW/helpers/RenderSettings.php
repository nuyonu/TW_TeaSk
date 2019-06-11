<?php

class RenderSettings
{
    public static function buttons()
    {
        if (Parameters::getData('github')) {
            echo '<a href="/settings/dissconect1"> <button type="button" class="logare" id="logare1">Disconnect Github</button></a>';
        } else {
            echo '<a href="/settings/github"> <button type="button" class="logare" id="logare1">Gitbub</button></a>';
        }
        if (Parameters::getData('linkedln')) {
            echo '<a href="/settings/dissconect2"> <button type="button" class="logare" id="logare2">Disconnect Linkedin</button></a>';
        } else {
            echo '<a href="/settings/linkedln"> <button type="button" class="logare" id="logare2">Linkedin</button></a>';
        }
    }
}