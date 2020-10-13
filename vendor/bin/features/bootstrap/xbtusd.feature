Feature: Get XBT:USD info
    Scenario: User wants information on XBT/USD trading pair
        Given User calls Kraken Public api
        When User requests XBT/USD trading pair from "https://api.kraken.com/0/public/Ticker?pair=XBTUSD"
        Then User should get 
      