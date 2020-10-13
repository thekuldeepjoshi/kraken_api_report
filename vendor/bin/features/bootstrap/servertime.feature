Feature: Server Time
    Scenario: User wants Server Time 
        Given User calls Kraken Public api
        When User request Time from "https://api.kraken.com/0/public/Time"
        Then User should get Time with unixtime 
        
