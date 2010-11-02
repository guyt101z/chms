##############################
# ChMS System Database Version
##############################

INSERT INTO _version VALUES('1.1');



###############
# Registry Data
###############

INSERT INTO registry VALUES(null, 'membership_termination_reason', 'Moved out of the area,Deceased,Switching to a different church');



###########
# US States
###########

INSERT INTO us_state(name, abbreviation) VALUES ('Alabama', 'AL');
INSERT INTO us_state(name, abbreviation) VALUES ('Alaska', 'AK');
INSERT INTO us_state(name, abbreviation) VALUES ('Arizona', 'AZ');
INSERT INTO us_state(name, abbreviation) VALUES ('Arkansas', 'AR');
INSERT INTO us_state(name, abbreviation) VALUES ('California', 'CA');
INSERT INTO us_state(name, abbreviation) VALUES ('Colorado', 'CO');
INSERT INTO us_state(name, abbreviation) VALUES ('Connecticut', 'CT');
INSERT INTO us_state(name, abbreviation) VALUES ('Delaware', 'DE');
INSERT INTO us_state(name, abbreviation) VALUES ('District of Columbia', 'DC');
INSERT INTO us_state(name, abbreviation) VALUES ('Florida', 'FL');
INSERT INTO us_state(name, abbreviation) VALUES ('Georgia', 'GA');
INSERT INTO us_state(name, abbreviation) VALUES ('Hawaii', 'HI');
INSERT INTO us_state(name, abbreviation) VALUES ('Idaho', 'ID');
INSERT INTO us_state(name, abbreviation) VALUES ('Illinois', 'IL');
INSERT INTO us_state(name, abbreviation) VALUES ('Indiana', 'IN');
INSERT INTO us_state(name, abbreviation) VALUES ('Iowa', 'IA');
INSERT INTO us_state(name, abbreviation) VALUES ('Kansas', 'KS');
INSERT INTO us_state(name, abbreviation) VALUES ('Kentucky', 'KY');
INSERT INTO us_state(name, abbreviation) VALUES ('Louisiana', 'LA');
INSERT INTO us_state(name, abbreviation) VALUES ('Maine', 'ME');
INSERT INTO us_state(name, abbreviation) VALUES ('Maryland', 'MD');
INSERT INTO us_state(name, abbreviation) VALUES ('Massachusetts', 'MA');
INSERT INTO us_state(name, abbreviation) VALUES ('Michigan', 'MI');
INSERT INTO us_state(name, abbreviation) VALUES ('Minnesota', 'MN');
INSERT INTO us_state(name, abbreviation) VALUES ('Mississippi', 'MS');
INSERT INTO us_state(name, abbreviation) VALUES ('Missouri', 'MO');
INSERT INTO us_state(name, abbreviation) VALUES ('Montana', 'MT');
INSERT INTO us_state(name, abbreviation) VALUES ('Nebraska', 'NE');
INSERT INTO us_state(name, abbreviation) VALUES ('Nevada', 'NV');
INSERT INTO us_state(name, abbreviation) VALUES ('New Hampshire', 'NH');
INSERT INTO us_state(name, abbreviation) VALUES ('New Jersey', 'NJ');
INSERT INTO us_state(name, abbreviation) VALUES ('New Mexico', 'NM');
INSERT INTO us_state(name, abbreviation) VALUES ('New York', 'NY');
INSERT INTO us_state(name, abbreviation) VALUES ('North Carolina', 'NC');
INSERT INTO us_state(name, abbreviation) VALUES ('North Dakota', 'ND');
INSERT INTO us_state(name, abbreviation) VALUES ('Ohio', 'OH');
INSERT INTO us_state(name, abbreviation) VALUES ('Oklahoma', 'OK');
INSERT INTO us_state(name, abbreviation) VALUES ('Oregon', 'OR');
INSERT INTO us_state(name, abbreviation) VALUES ('Pennsylvania', 'PA');
INSERT INTO us_state(name, abbreviation) VALUES ('Rhode Island', 'RI');
INSERT INTO us_state(name, abbreviation) VALUES ('South Carolina', 'SC');
INSERT INTO us_state(name, abbreviation) VALUES ('South Dakota', 'SD');
INSERT INTO us_state(name, abbreviation) VALUES ('Tennessee', 'TN');
INSERT INTO us_state(name, abbreviation) VALUES ('Texas', 'TX');
INSERT INTO us_state(name, abbreviation) VALUES ('Utah', 'UT');
INSERT INTO us_state(name, abbreviation) VALUES ('Vermont', 'VT');
INSERT INTO us_state(name, abbreviation) VALUES ('Virginia', 'VA');
INSERT INTO us_state(name, abbreviation) VALUES ('Washington', 'WA');
INSERT INTO us_state(name, abbreviation) VALUES ('West Virginia', 'WV');
INSERT INTO us_state(name, abbreviation) VALUES ('Wisconsin', 'WI');
INSERT INTO us_state(name, abbreviation) VALUES ('Wyoming', 'WY');



#################
# Other Type Data
#################

INSERT INTO address_type VALUES(1, 'Home');
INSERT INTO address_type VALUES(2, 'Work');
INSERT INTO address_type VALUES(3, 'Other');
INSERT INTO address_type VALUES(4, 'Temporary');

INSERT INTO attribute_data_type VALUES(1, 'Checkbox');
INSERT INTO attribute_data_type VALUES(2, 'Date');
INSERT INTO attribute_data_type VALUES(3, 'DateTime');
INSERT INTO attribute_data_type VALUES(4, 'Text');
INSERT INTO attribute_data_type VALUES(5, 'Immutable Single Dropdown');
INSERT INTO attribute_data_type VALUES(6, 'Immutable Multiple Dropdown');
INSERT INTO attribute_data_type VALUES(7, 'Mutable Single Dropdown');
INSERT INTO attribute_data_type VALUES(8, 'Mutable Multiple Dropdown');

INSERT INTO comment_privacy_type VALUES(1, 'Confidential');
INSERT INTO comment_privacy_type VALUES(2, 'Staff');
INSERT INTO comment_privacy_type VALUES(3, 'General');

INSERT INTO email_broadcast_type VALUES(1, 'Public List');
INSERT INTO email_broadcast_type VALUES(2, 'Private List');
INSERT INTO email_broadcast_type VALUES(3, 'Announcement Only');

INSERT INTO email_message_status_type VALUES(1, 'Not Yet Analyzed');
INSERT INTO email_message_status_type VALUES(2, 'Pending Send');
INSERT INTO email_message_status_type VALUES(3, 'Completed');
INSERT INTO email_message_status_type VALUES(4, 'Completed With Some Rejections');
INSERT INTO email_message_status_type VALUES(5, 'Rejected');
INSERT INTO email_message_status_type VALUES(6, 'Error');

INSERT INTO group_type VALUES (1, 'Regular Group');
INSERT INTO group_type VALUES (2, 'Group Category');
INSERT INTO group_type VALUES (4, 'Smart Group');
INSERT INTO group_type VALUES (8, 'Growth Group');

INSERT INTO group_role_type VALUES (1, 'Volunteer');
INSERT INTO group_role_type VALUES (2, 'Participant');

INSERT INTO growth_group_day_type VALUES (1, 'Monday');
INSERT INTO growth_group_day_type VALUES (2, 'Tuesday');
INSERT INTO growth_group_day_type VALUES (3, 'Wednesday');
INSERT INTO growth_group_day_type VALUES (4, 'Thursday');
INSERT INTO growth_group_day_type VALUES (5, 'Friday');
INSERT INTO growth_group_day_type VALUES (6, 'Saturday');
INSERT INTO growth_group_day_type VALUES (7, 'Sunday');

INSERT INTO image_type VALUES(1, 'jpg');
INSERT INTO image_type VALUES(2, 'png');
INSERT INTO image_type VALUES(3, 'gif');

INSERT INTO marital_status_type VALUES(1, 'Not Specified');
INSERT INTO marital_status_type VALUES(2, 'Single');
INSERT INTO marital_status_type VALUES(3, 'Married');
INSERT INTO marital_status_type VALUES(4, 'Separated');

INSERT INTO marriage_status_type VALUES(1, 'Married');
INSERT INTO marriage_status_type VALUES(2, 'Separated');
INSERT INTO marriage_status_type VALUES(3, 'Divorced');
INSERT INTO marriage_status_type VALUES(4, 'Widowed');

INSERT INTO membership_status_type VALUES(1, 'Non-Member');
INSERT INTO membership_status_type VALUES(2, 'Former Member');
INSERT INTO membership_status_type VALUES(3, 'Member');
INSERT INTO membership_status_type VALUES(4, 'Child Of Member');

INSERT INTO permission_type VALUES(1, 'Edit Data');
INSERT INTO permission_type VALUES(2, 'Access Stewardship');
INSERT INTO permission_type VALUES(4, 'Access Confidential Notes');
INSERT INTO permission_type VALUES(8, 'Merge Individuals');
INSERT INTO permission_type VALUES(16, 'Edit Membership Status');
INSERT INTO permission_type VALUES(32, 'Add New Individual');

INSERT INTO phone_type VALUES(1, 'Home');
INSERT INTO phone_type VALUES(2, 'Work');
INSERT INTO phone_type VALUES(3, 'Mobile');
INSERT INTO phone_type VALUES(4, 'Fax');
INSERT INTO phone_type VALUES(5, 'Other');

INSERT INTO query_data_type VALUES(1, 'String Value');
INSERT INTO query_data_type VALUES(2, 'Integer Value');
INSERT INTO query_data_type VALUES(4, 'Date Value');
INSERT INTO query_data_type VALUES(8, 'Type Value');
INSERT INTO query_data_type VALUES(16, 'Boolean Value');
INSERT INTO query_data_type VALUES(32, 'Object Value');
INSERT INTO query_data_type VALUES(1024, 'Custom Value');

INSERT INTO query_node_type VALUES(1, 'Standard Node');
INSERT INTO query_node_type VALUES(2, 'Attribute Node');

INSERT INTO relationship_type VALUES(1, 'Parental');
INSERT INTO relationship_type VALUES(2, 'Child');
INSERT INTO relationship_type VALUES(3, 'Sibling');
INSERT INTO relationship_type VALUES(4, 'Grandparent');
INSERT INTO relationship_type VALUES(5, 'Grandchild');

INSERT INTO role_type VALUES(1, 'Volunteer');
INSERT INTO role_type VALUES(2, 'Staff Member');
INSERT INTO role_type VALUES(3, 'ChMS Administrator');

INSERT INTO stewardship_contribution_type VALUES (1, 'Check');
INSERT INTO stewardship_contribution_type VALUES (2, 'Cash');
INSERT INTO stewardship_contribution_type VALUES (3, 'Credit Card');
INSERT INTO stewardship_contribution_type VALUES (4, 'Credit Card, Recurring');
INSERT INTO stewardship_contribution_type VALUES (5, 'Stock');
INSERT INTO stewardship_contribution_type VALUES (6, 'Automobile');
INSERT INTO stewardship_contribution_type VALUES (7, 'Returned Check');
INSERT INTO stewardship_contribution_type VALUES (8, 'Summary');
INSERT INTO stewardship_contribution_type VALUES (9, 'Other');

INSERT INTO stewardship_batch_status_type VALUES(1, 'New Batch');
INSERT INTO stewardship_batch_status_type VALUES(2, 'Posted In Full');
INSERT INTO stewardship_batch_status_type VALUES(3, 'Unposted Changes Exist');


##############
# Starter Data
##############

INSERT INTO other_contact_method VALUES(null, 'Twitter');
INSERT INTO other_contact_method VALUES(null, 'Facebook');
INSERT INTO other_contact_method VALUES(null, 'MySpace');
INSERT INTO other_contact_method VALUES(null, 'AOL Instant Messenger');
INSERT INTO other_contact_method VALUES(null, 'Yahoo! Messenger');

INSERT INTO attribute VALUES (null, 4, 'ACS Individual Number');
INSERT INTO attribute VALUES (null, 4, 'ACS Individual ID');
INSERT INTO attribute VALUES (null, 4, 'ACS Individual PKID');
INSERT INTO attribute VALUES (null, 4, 'ACS Family Number');
INSERT INTO attribute VALUES (null, 4, 'ACS Family Position');
INSERT INTO attribute VALUES (null, 5, 'Method of Joining ALCF');
INSERT INTO attribute VALUES (null, 6, 'Spritual Gifts');
INSERT INTO attribute VALUES (null, 7, 'Ministry Involvement - Assigned Interviewer');
INSERT INTO attribute VALUES (null, 2, 'Ministry Involvement - Date Placed');
INSERT INTO attribute VALUES (null, 3, 'Ministry Involvement - Scheduled Interview');
INSERT INTO attribute VALUES (null, 5, 'Ministry Involvement - Status');
INSERT INTO attribute VALUES (null, 5, 'Ministry Involvement - Status of Letter');
INSERT INTO attribute VALUES (null, 2, 'Date Baptized');
INSERT INTO attribute VALUES (null, 2, 'Date Accepted Christ');
INSERT INTO attribute VALUES (null, 2, 'Date Faith Recommitted');
INSERT INTO attribute VALUES (null, 4, 'Occupation');
INSERT INTO attribute VALUES (null, 4, 'Previous Church');

INSERT INTO query_operation VALUES (null,         16   , 'Is',  'Equal', true, null, null);
INSERT INTO query_operation VALUES (null, 1|2|4|8|   32|1024, 'Is Equal To', 'Equal', true, null, null);
INSERT INTO query_operation VALUES (null, 1|2|4|8|   32|1024, 'Is Not Equal To', 'NotEqual', true, null, null);
INSERT INTO query_operation VALUES (null, 1|2|4|8|      1024, 'Exists', 'IsNotNull', false, null, null);
INSERT INTO query_operation VALUES (null, 1|2|4|8|      1024, 'Does Not Exist', 'IsNull', false, null, null);
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Contains', 'Like', true, '%', '%');
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Does Not Contain', 'NotLike', true, '%', '%');
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Starts With', 'Like', true, null, '%');
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Does Not Start With', 'NotLike', true, null, '%');
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Ends With', 'Like', true, '%', null);
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Does Not End With', 'NotLike', true, '%', null);
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Is Greater Than', 'GreaterThan', true, null, null);
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Is Greater or Equal To', 'GreaterOrEqual', true, null, null);
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Is Less Than', 'LessThan', true, null, null);
INSERT INTO query_operation VALUES (null, 1|2|4        , 'Is Less Than or Equal To', 'LessOrEqual', true, null, null);

INSERT INTO query_node VALUES (null, 'Gender',                           1, 'Gender',                                       1024, 'M,F');
INSERT INTO query_node VALUES (null, 'Age',                              1, 'Age',                                             2,  null);
INSERT INTO query_node VALUES (null, 'Home City',                        1, 'PrimaryCityText',                                 1,  null);
INSERT INTO query_node VALUES (null, 'Membership Status',                1, 'MembershipStatusTypeId',                          8, 'MembershipStatusType');
INSERT INTO query_node VALUES (null, 'Marital Status',                   1, 'MaritalStatusTypeId',                             8, 'MaritalStatusType');
INSERT INTO query_node VALUES (null, 'Okay to Bulk Email',               1, 'CanEmailFlag',                                   16,  null);
INSERT INTO query_node VALUES (null, 'Okay to Bulk Mail',                1, 'CanMailFlag',                                    16,  null);
INSERT INTO query_node VALUES (null, 'Okay to Telephone',                1, 'CanPhoneFlag',                                   16,  null);
INSERT INTO query_node VALUES (null, 'Date of Birth',                    1, 'DateOfBirth',                                     4,  null);
INSERT INTO query_node VALUES (null, 'Group Participation - Start Date', 1, 'GroupParticipation->DateStart',                   4,  null);
INSERT INTO query_node VALUES (null, 'Group Participation - End Date',   1, 'GroupParticipation->DateEnd',                     4,  null);
INSERT INTO query_node VALUES (null, 'Group Participation - Role',       1, 'GroupParticipation->GroupRole->Name',             1,  null);
INSERT INTO query_node VALUES (null, 'Group Participation - Role Type',  1, 'GroupParticipation->GroupRole->GroupRoleTypeId',  8,  'GroupRoleType');
INSERT INTO query_node VALUES (null, 'Group Participation - Ministry',   1, 'GroupParticipation->Group->MinistryId',          32,  'Ministry LoadArrayByActiveFlag 1 Name');

####
#INSERT INTO query_node VALUES (null, 'Date Baptized',          2, null,                                 4, '13');
#INSERT INTO query_node VALUES (null, 'Date Accepted Christ',   2, null,                                 4, '14');
#INSERT INTO query_node VALUES (null, 'Date Faith Recommitted', 2, null,                                 4, '15');
#INSERT INTO query_node VALUES (null, 'Occupation',             2, null,                                 1, '16');
#INSERT INTO query_node VALUES (null, 'Previous Church',        2, null,                                 1, '17');
#INSERT INTO query_node VALUES (null, 'Spritual Gifts',         2, null,                                1024, '7');
#INSERT INTO query_node VALUES (null, 'Method of Joining ALCF', 2, null,                                1024, '6');
#INSERT INTO query_node VALUES (null, 'Ministry Involvement - Assigned Interviewer', 2, null,           1024, '8');
#INSERT INTO query_node VALUES (null, 'Ministry Involvement - Date Placed',          2, null,                                 4, '9');
#INSERT INTO query_node VALUES (null, 'Ministry Involvement - Scheduled Interview',          2, null,                                 4, '10');
#INSERT INTO query_node VALUES (null, 'Ministry Involvement - Status', 2, null,                         1024, '11');
#INSERT INTO query_node VALUES (null, 'Ministry Involvement - Status of Letter', 2, null,               1024, '12');
####


INSERT INTO stewardship_fund VALUES(null, null, 'Tithes and Offering', null, null, true);
INSERT INTO stewardship_fund VALUES(null, null, 'Buildling Fund', null, null, true);
INSERT INTO stewardship_fund VALUES(null, null, 'Imagine Campaign', null, null, true);

INSERT INTO login VALUES(null, 3, 65535, 'admin', '25498b022880496af16a162ca4edfc52', NULL, NULL, true, true, 'admin@alcf.net', 'Admin', null, 'User');