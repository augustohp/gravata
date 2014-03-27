Feature: Apply a tie (gravata) on an avatar
    In order to have an awesome avatar
    As a gravatar user
    I must be able to apply another another image (overlay) to the avatar

Scenario: Search an existing avatar
    Given I visit homepage
    When I search for an avatar
    Then I should see my avatar with a nice tie
