var helpers = helpers || {};

helpers.isArray = function (v) {
  return Object.prototype.toString.call(v) === "[object Array]";
};
helpers.isBool = function (v) {
  return Object.prototype.toString.call(v) === "[object Boolean]";
};
helpers.isNumber = function (v) {
  Object.prototype.toString.call(v) === "[object Number]";
};
helpers.isNumeric = function (v) {
  try {
    return isFinite(v) && !isNaN(parseFloat(v));
  } catch (error) {
    return false;
  }
};
helpers.isString = function (v) {
  return Object.prototype.toString.call(v) === "[object String]";
};
helpers.isObject = function (v) {
  return Object.prototype.toString.call(v) === "[object Object]";
};
helpers.isFunction = function (v) {
  return typeof v === "function";
};
helpers.isPromise = function (v) {
  return Object.prototype.toString.call(v) === "[object Promise]";
};

helpers.randomInt = function (min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min);
};
helpers.randomString = function (
  len = 8,
  seeds = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
) {
  let r = "";
  for (let i = 0; i < len; i++) {
    r += seeds[randomInt(0, seeds.length - 1)];
  }
  return r;
};
helpers.strPad = function (str, n, padString = "0") {
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

helpers.firstLetterUpper = function (str) {
  return str && str[0].toUpperCase() + str.substring(1);
};
helpers.reverseString = function (str) {
  return str.split("").reverse().join("");
};
