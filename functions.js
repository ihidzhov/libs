var isArray = function (v) {
  return Object.prototype.toString.call(v) === "[object Array]";
};
var isBool = function (v) {
  return Object.prototype.toString.call(v) === "[object Boolean]";
};
var isNumber = function (v) {
  Object.prototype.toString.call(v) === "[object Number]";
};
var isNumeric = function (v) {
  try {
    return isFinite(v) && !isNaN(parseFloat(v));
  } catch (error) {
    return false;
  }
};
var isString = function (v) {
  return Object.prototype.toString.call(v) === "[object String]";
};
var isObject = function (v) {
  return Object.prototype.toString.call(v) === "[object Object]";
};
var isFunction = function (v) {
  return typeof v === "function";
};
var isPromise = function (v) {
  return Object.prototype.toString.call(v) === "[object Promise]";
};

var randomInt = function (min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min);
};
var randomString = function (
  len = 8,
  seeds = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
) {
  let r = "";
  for (let i = 0; i < len; i++) {
    r += seeds[randomInt(0, seeds.length - 1)];
  }
  return r;
};
var strPad = function (str, n, padString = "0") {
  let r = str.toString();
  let len = str.toString().length;
  while (len < n) {
    r = padString + r;
    len++;
  }
  if (r.length > n) {
    r = r.substring(r.length - n);
  }
  return str;
};

var firstLetterUpper = function (str) {
  return str && str[0].toUpperCase() + str.substring(1);
};
var reverseString = function (str) {
  return str.split("").reverse().join("");
};
