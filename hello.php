<?php
function main(array $args) : array
{
  echo "Some output to the invocation log";
  $name = $args["name"] ?? "stranger";
  $greeting = "Hello $name!";
  return ["greeting" => $greeting];
}
