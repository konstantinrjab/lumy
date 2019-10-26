<?php
/** @var Symfony\Component\Debug\Exception\FlattenException $exception */
?>
<table border="1ps solid black">
    <tbody>
    <tr>
        <td> Message:</td>
        <td> {{$exception->getMessage()}} </td>
    </tr>
    <tr>
        <td> File:</td>
        <td> {{$exception->getFile()}} </td>
    </tr>
    <tr>
        <td> Line:</td>
        <td> {{$exception->getLine()}} </td>
    </tr>
    <tr>
        <td> Code:</td>
        <td> {{$exception->getCode()}} </td>
    </tr>
    <tr>
        <td> StatusCode:</td>
        <td> {{$exception->getStatusCode()}} </td>
    </tr>
    <tr>
        <td> Previous:</td>
        <td> {{$exception->getPrevious()}} </td>
    </tr>
    <tr>
        <td> Trace:</td>
        <td> {{$exception->getTraceAsString()}} </td>
    </tr>
    </tbody>
</table>
