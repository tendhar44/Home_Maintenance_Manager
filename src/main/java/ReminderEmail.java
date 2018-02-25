public class ReminderEmail {

	//Data field
	private String to;
	private String from;
	private String host;
	private String subject;
	private String text;
	
	
	public ReminderEmail(User user, Task task) {
		to = user.getEmailAddress();
		subject = "Reminder for " + task.getName();
		text = "Hello " + user.getFirstName() + " " + user.getLastName() + ", \n\n This is a reminder for: \n\n" + task.getName() 
		+ " - " + task.getDescription() + ". \n\nThis task is due " + task.getDueDate().toString() + ". Once finished, please navigate"
				+ " to the site to mark that it is completed. \n\n Thanks! \n\n Home Maintanence Manager";
	}

	public String getTo() {
		return to;
	}
	public void setTo(String to) {
		this.to = to;
	}
	public String getFrom() {
		return from;
	}
	public void setFrom(String from) {
		this.from = from;
	}
	public String getHost() {
		return host;
	}
	public void setHost(String host) {
		this.host = host;
	}
	public String getSubject() {
		return subject;
	}
	public void setSubject(String subject) {
		this.subject = subject;
	}
	public String getText() {
		return text;
	}
	public void setText(String text) {
		this.text = text;
	}

	@Override
	public String toString() {
		return "ReminderEmail [to=" + to + ", from=" + from + ", host=" + host + ", subject=" + subject + ", text="
				+ text + "]";
	}
	
	


}