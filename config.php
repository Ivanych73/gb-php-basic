<?php

const SERVER = "localhost";
const DB = "gallery";
const LOGIN = "root";
const PASS = "root";

const DETAIL_VIEW_PAGE = "detailview.php";
const ADD_REVIEW_PAGE = "addreview.php";
const ADD_UPDATE_GOOD_PAGE = "addupdategood.php";

$connect = mysqli_connect(SERVER,LOGIN,PASS,DB);