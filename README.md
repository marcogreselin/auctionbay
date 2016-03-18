# AuctionBay
This is a working replica of eBay (looking a little nicer) built with PHP and MySQL. It has responsive design and the beautiful [Flat UI](http://designmodo.github.io/Flat-UI/). And now a few references:

- A video presentation of the site is available on [YouTube](https://youtu.be/eVZXFArkstQ).
- The live demo is available at this addres: http://auctionbay.bitnamiapp.com/
- Finally, the databse schema is available on Vertabelo. You can have a look [here](https://my.vertabelo.com/public-model-view/hQaOq2J4GE6xQfuALRgJjFt9dLCko1HSHHI8kapj2B3xVHWGva408JTR0L8nRuvQ?x=2843&y=2930&zoom=0.6500).

## How to run it
Well why would you want to? You need to create a MySQL database based on the schema on the link above and have XAMPP (or any LAMP stack, really) installed. Kind of overhead. Just watch the video or visit the live demo instead.

## Features implemented
1. Users can register with the system and create accounts. Users have roles of seller or buyer with different privileges.
2. Sellers can create auctions for particular items, setting suitable conditions and features of the items including the item description, categorisation, starting price, reserve price and end date.
3. Buyers can search the system for particular kinds of item being auctioned and can browse and visually re-arrange listings of items within categories. 
4. Buyers can bid for items and see other buyers’ bids. The system will manage the auction until the set end time and award the item to the highest bidder. The system should confirm to both the winner and seller of an auction its outcome.
5. Buyers can watch auctions on items and receive emailed updates on bids on those items including notifications when they are outbid.
6. Sellers can receive reports on the progress of the auction through to completion and how much viewing traffic their auction items have had.
7. Buyers and sellers have visible ratings aggregated from the feedback on their participation in auctions.
