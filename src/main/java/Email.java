public class Email {

	//Data field
	private String to;
	private String from;
	private String host;
	private String subject;
	private String text;
	
	/////////////////////////
	/////constructors
	//////////////////////////
	public Email() {}		
	public Email(String to, String from, String host, String subject) {
		super();
		this.to = to;
		this.from = from;
		this.host = host;
		this.subject = subject;
	}
	public Email(String to, String from, String host, String subject, String text) {
		this.to = to;
		this.from = from;
		this.host = host;
		this.subject = subject;
		this.text = text;
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


}