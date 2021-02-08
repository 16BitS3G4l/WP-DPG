# WP-DPG (WordPress Plugin)
Using WP-DPG, you can generate dummy products for WooCommerce stores. 

## Generated Data
The plugin generates a WooCommerce import compatible CSV file with the following dynamic data:
1. Image URL (This will be used as the product image)
2. Product Type 
3. Sales Price

## Quick Example Case
(coming soon) 

## Notes on Implementation
WP-DPG uses images from Google's content delivery network, Gstatic, for all the images provided. Because the CDN caches this data (which was targeted by the API used for getting these images), the locations of these images might not be optimal for clients in different geographical locations. Again, this emphasizes how much of a tool WP-DPG is for a testing environment, rather than an actual production use case. 
