Feature: Gravatar search for existing avatars
    In order to find an avatar
    As a gravatar user
    I must be able to search an avatar by e-mail

Scenario: Search an existing avatar
    Given I visit homepage
    And I type "augusto@phpsp.org.br" as the e-mail
    When I click Search
    Then I should see my avatar
