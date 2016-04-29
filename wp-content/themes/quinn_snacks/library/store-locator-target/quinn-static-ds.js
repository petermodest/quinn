/**
 * @extends storeLocator.StaticDataFeed
 * @constructor
 */
function QuinnDataSource() {
  $.extend(this, new storeLocator.StaticDataFeed);

  var that = this;
  $.get('http://www.quinnsnacks.com/wp-content/themes/quinn_snacks/library/store-locator-target/target-stores.php', function(data) {
    that.setStores(that.parse_(data));
  });
}

/**
 * @const
 * @type {!storeLocator.FeatureSet}
 * @private
 */
QuinnDataSource.prototype.FEATURES_ = new storeLocator.FeatureSet(
);

/**
 * @return {!storeLocator.FeatureSet}
 */
QuinnDataSource.prototype.getFeatures = function() {
  return this.FEATURES_;
};

/**
 * @private
 * @param {string} csv
 * @return {!Array.<!storeLocator.Store>}
 */
QuinnDataSource.prototype.parse_ = function(csv) {
  var stores = [];
  var rows = csv.split('\n');
  var headings = this.parseRow_(rows[0]);

  for (var i = 1, row; row = rows[i]; i++) {
    row = this.toObject_(headings, this.parseRow_(row));
    var features = new storeLocator.FeatureSet;

    var position = new google.maps.LatLng(row.Ycoord, row.Xcoord);

    var shop = this.join_([row.store_name], ', ');
    var store_city = this.join_([row.store_city, row.store_state, row.store_zip], ', ');

    var store = new storeLocator.Store(row.uuid, position, features, {
      title: row.store_name,
      address: this.join_([row.store_street, store_city], '<br>')
      
    });

    stores.push(store);
  }
 
 	console.log(stores);
 
  return stores;
};

/**
 * Joins elements of an array that are non-empty and non-null.
 * @private
 * @param {!Array} arr array of elements to join.
 * @param {string} sep the separator.
 * @return {string}
 */
QuinnDataSource.prototype.join_ = function(arr, sep) {
  var parts = [];
  for (var i = 0, ii = arr.length; i < ii; i++) {
    arr[i] && parts.push(arr[i]);
  }
  return parts.join(sep);
};

/**
 * Very rudimentary CSV parsing - we know how this particular CSV is formatted.
 * IMPORTANT: Don't use this for general CSV parsing!
 * @private
 * @param {string} row
 * @return {Array.<string>}
 */
QuinnDataSource.prototype.parseRow_ = function(row) {
  // Strip leading quote.
  if (row.charAt(0) == '"') {
    row = row.substring(1);
  }
  // Strip trailing quote. There seems to be a character between the last quote
  // and the line ending, hence 2 instead of 1.
  if (row.charAt(row.length - 2) == '"') {
    row = row.substring(0, row.length - 2);
  }

  row = row.split('","');


  return row;
};

/**
 * Creates an object mapping headings to row elements.
 * @private
 * @param {Array.<string>} headings
 * @param {Array.<string>} row
 * @return {Object}
 */
QuinnDataSource.prototype.toObject_ = function(headings, row) {
  var result = {};
  for (var i = 0, ii = row.length; i < ii; i++) {
    result[headings[i]] = row[i];
  }
  return result;
};
