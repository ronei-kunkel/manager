# Manager

## How run

Here are all you need to run the project

`sudo ./start.sh`

## The flow

1. Github sends notification of event occoured to system.
2. System create coroutine to parameterize the data and publish on intern queue
3. System at the same time send the response to github indicates that notification was received.

In parallel, have an process running while application alive to listen the intern queue that received the parameterized data.

4. The process pass the message that just consume to event processor in order to handle with specific event behavior.

Depends on event type, the processor can save it on database, enqueue data on more specific event queue to do other actions in many other contexts, or make an more specific action. All depends
