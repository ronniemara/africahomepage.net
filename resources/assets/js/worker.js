 var cfsign = require('aws-cloudfront-sign');
// //
function sign(str) {
  return cfsign.getSignedUrl(str, signingParams);
}

var signingParams = {
  keypairId: 'APKAJGMF5S4BA6LURESA',

  // Optional - this can be used as an alternative to privateKeyString
  privateKeyString: '-----BEGIN RSA PRIVATE KEY-----\n' +
    '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\n'     +
    '-----END RSA PRIVATE KEY-----',
  expireTime: Date.now() + 6000000
};


 module.exports = function(self) {
    self.onmessage = function(ev) {
        for (var i = 0; i < ev.data.length; i++) {
                  let url = ev.data[i];
                  let signed = sign(url);
                  self.postMessage(signed);
                }

    };
};
