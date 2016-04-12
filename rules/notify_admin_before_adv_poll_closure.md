#NOTIFY ADMIN BEFORE ADVANCED POLL CLOSURE

**RULES|COMPONENTS|RULES SCHEDULER|ADVANCED POLL**

##CREATE COMPONENT

 1.  Create component plugin of type Rule (`admin/config/workflow/rules/components/add`) - name it "***Notify admin about poll closure***".
 2. Provide a variable for the component to act on. Variable `Data type = Content`, `Label - Poll Node`, `Machine name = poll_node`, `Usage = Parameter`.  



3. Add Conditions if you need any
4. Add Actions -> Send HTML e-mail. Set you email parameters
*below is the export of the component*

```
{ "rules_notify_admin_about_poll_closure" : {
    "LABEL" : "Notify admin about poll closure",
    "PLUGIN" : "rule",
    "OWNER" : "rules",
    "REQUIRES" : [ "rules_i18n", "rules", "mimemail" ],
    "USES VARIABLES" : { "poll_node" : { "label" : "Poll Node", "type" : "node" } },
    "DO" : [
      { "mimemail" : {
          "key" : "poll_closure_notify_admin",
          "to" : "adminemail@email.com",
          "subject" : "Poll will close tomorrow",
          "body" : "Poll [poll-node:title] will close tomorrow",
          "plaintext" : [ "" ],
          "language" : [ "" ]
        }
      }
    ]
  }
}  
```
 
 
---


##CREATE RULE

 1. React on Events: "`After saving new content of type Advanced Poll`", "`After updating existing content of type Advanced Poll`"
 2. Add Conditions "Entity has field": Entity: `node`, Field: `advpoll_dates`
 3. Add action "***Schedule component evaluation***" - select the component that you created "***Notify admin about poll closure***".  

    Scheduled Evaluation date -> `node:advpoll-dates:value2`. Add offset "`-1 days`". This will schedule the email 1 day before poll closing.  

    Set an identifier to something like "*`Poll closure notification: [node:nid] - [node:title]`*". It should have unique values everytime new scheduled task is added in queue, that is why you should use `node:title` and `node:nid`.

    Set Poll Node field to `node`.
    
    Save your rule and test.

    
```
{ "rules_schedule_notification_about_poll_closure" : {
    "LABEL" : "Schedule notification about poll closure",
    "PLUGIN" : "reaction rule",
    "OWNER" : "rules",
    "REQUIRES" : [ "rules", "rules_scheduler" ],
    "ON" : {
      "node_insert--advpoll" : { "bundle" : "advpoll" },
      "node_update--advpoll" : { "bundle" : "advpoll" }
    },
    "IF" : [
      { "entity_has_field" : { "entity" : [ "node" ], "field" : "advpoll_dates" } }
    ],
    "DO" : [
      { "schedule" : {
          "component" : "rules_notify_admin_about_poll_closure",
          "date" : {
            "select" : "node:advpoll-dates:value2",
            "date_offset" : { "value" : -86400 }
          },
          "identifier" : "Poll closure notification: [node:nid] - [node:title]",
          "param_poll_node" : [ "node" ]
        }
      }
    ]
  }
}
```

NOTE: Cron should be enabled and configured on your website in order for scheduled events to work properly.
